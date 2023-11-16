<?php

namespace App\Livewire\Spiski\Calc;

use App\Models\CalcColumn;
use App\Models\Ingredient;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use function PHPUnit\Framework\throwException;

class Calc extends Component
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
    public $units = [];
    public $calcValues = [];
    public $selectUnit = 'net';
    public $alert = false;

    public function mount()
    {
        $columns = DB::table('calc_columns')->orderBy('param')->get()->toArray();
        foreach ($columns as $column) {
            $this->columns[$column->id] = $column->name;
        }

        $units = DB::table('units')->get()->toArray();
        foreach ($units as $unit) {
            $columns = array_flip($this->columns);
            if(!empty($columns[$unit->name])){ continue; }
            $this->units[$unit->id] = $unit->name;
        }

        $calcValues = DB::table('calcs')->get()->toArray();
        foreach ($calcValues as $item) {
            $this->calcValues[$item->ing_id] = json_decode($item->datas, true);
        }

    }

    public function addUnitInColumn()
    {
        $this->columns[] = $this->selectUnit;

        $last = CalcColumn::latest('id')->first();

        $check = CalcColumn::where('name', '=', $this->selectUnit)->first();
        if($check === null){
            CalcColumn::create(['name' => $this->selectUnit, 'param' => $last->param + 1]);
        }

        session()->flash('success', "Колонка <strong class='text-black'>".$this->selectUnit."</strong> успешно добавлен в конец таблицы");
        return redirect()->to(route('spisok.calc.index'));

    }

    public function destroy()
    {
        CalcColumn::where('id', '=', $this->selectedItem)->delete();
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

    public function saveCalc()
    {

        $newCalcValues = [];
        foreach ($this->calcValues as $key => $ingredient) {
            foreach ($this->columns as $k => $column) {
                $newCalcValues[$key][$k] = $this->calcValues[$key][$k] ?? '';
            }
        }

        $saveData = [];
        $i = 0;
        foreach ($newCalcValues as $k => $newCalcValue) {
            $saveData[$i]['ing_id'] = $k;
            $saveData[$i]['datas'] = json_encode($newCalcValue);
            $i++;
        }
        batch()->update(new \App\Models\Calc(), $saveData, 'ing_id');

        session()->flash('success', "Данные калькулятора успешно сохранены");
        return redirect()->to(route('spisok.calc.index'));
    }

    public function render()
    {
        return view('livewire.spiski.calc.calc',
            [
                'ingredients' => Ingredient::search($this->search)
                    ->orderBy($this->sortBy, $this->sortDir)
                    ->paginate($this->perPage)
            ]
        );
    }
}
