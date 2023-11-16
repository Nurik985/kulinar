<?php

namespace App\Livewire\Spiski\Minerals;

use App\Models\Ingredient;
use App\Models\MineralColumn;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Minerals extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'name';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    #[Url()]
    public $perPage = 10;

    public $selectedItem = 0;
    public $modText;

    public $columns = [];
    public $mineralValues = [];

    public $column;
    public $columnClass = '';


    public function mount()
    {
        $columns = DB::table('mineral_columns')->orderBy('id', 'DESC')->get()->toArray();
        foreach ($columns as $column) {
            $this->columns[$column->id] = $column->name;
        }

        $mineralValues = DB::table('minerals')->get()->toArray();
        foreach ($mineralValues as $item) {
            $this->mineralValues[$item->ing_id] = json_decode($item->datas, true);
        }

    }

    public function addColumn()
    {
        if(!$this->column){
            $this->columnClass = 'cerror';
        } else {
            $last = MineralColumn::latest('id')->first();

            $check = MineralColumn::where('name', '=', $this->column)->first();
            if($check === null){
                MineralColumn::create(['name' => $this->column]);
            }

            session()->flash('success', "Колонка <strong class='text-black'>".$this->column."</strong> успешно добавлен");
            return redirect()->to(route('spisok.minerals.index'));
        }
    }

    public function openDelModal($sectionId, $text)
    {
        $this->selectedItem = $sectionId;
        $this->modText = $text;

        $this->dispatch('openDelModal');
    }

    public function closeDelModal()
    {
        $this->dispatch('closeDelModal');
    }

    public function destroy()
    {
        MineralColumn::where('id', '=', $this->selectedItem)->delete();
        unset($this->columns[$this->selectedItem]);
        $this->closeDelModal();
    }

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {

        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function saveMinerals()
    {


        $newMineralValues = [];
        foreach ($this->mineralValues as $key => $ingredient) {
            foreach ($this->columns as $k => $column) {
                $newMineralValues[$key][$k] = $this->mineralValues[$key][$k] ?? '';
            }
        }

        $saveData = [];
        $i = 0;
        foreach ($newMineralValues as $k => $newMineralValue) {
            $saveData[$i]['ing_id'] = $k;
            $saveData[$i]['datas'] = json_encode($newMineralValue);
            $i++;
        }
        batch()->update(new \App\Models\Mineral(), $saveData, 'ing_id');

        session()->flash('success', "Данные Минералы/Витамины успешно сохранены");
        return redirect()->to(route('spisok.minerals.index'));
    }


    public function render()
    {
        return view('livewire.spiski.minerals.minerals',
            [
                'ingredients' => Ingredient::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
