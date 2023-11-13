<?php

namespace App\Livewire\Reklama;

use App\Models\Ad;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Reklama extends Component
{
    public $additional_mob1;
    public $additional_mob2;
    public $rubrica2_desc = [];
    public $rubrica2_mob = [];
    public $end_text_desc = [];
    public $end_text_mob = [];
    public $steps_desc = [];
    public $steps_mob = [];
    public $recipe_desctop = [];
    public $recipe_amp = [];
    public $recipe_mobile = [];
    public $rubrica_desctop = [];
    public $rubrica_mobile = [];
    public $rubrica_amp = [];

    public function mount()
    {
        $ads = DB::table('ads')->get();

        if(!$ads->isEmpty()){
            foreach ($ads as $ad) {
                if($ad->type == 'additional_mob'){

                    if(!empty($ad->value)){
                        $additional_mob = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        if(!empty($additional_mob[0])){
                            $this->additional_mob1 = htmlspecialchars_decode(str_replace('???', '\n', $additional_mob[0]));
                        }
                        if(!empty($additional_mob[1])) {
                            $this->additional_mob2 = htmlspecialchars_decode(str_replace('???', '\n', $additional_mob[1]));
                        }
                    }

                }

                if($ad->type == 'rubrica2_desc') {
                    if(!empty($ad->value)) {
                        $rubrica2_desc = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($rubrica2_desc as $k => $item) {
                            $this->rubrica2_desc[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'rubrica2_mob') {
                    if(!empty($ad->value)) {
                        $rubrica2_mob = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($rubrica2_mob as $k => $item) {
                            $this->rubrica2_mob[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'end_text_desc') {
                    if(!empty($ad->value)) {
                        $end_text_desc = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($end_text_desc as $k => $item) {
                            $this->end_text_desc[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'end_text_mob') {
                    if(!empty($ad->value)) {
                        $end_text_mob = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($end_text_mob as $k => $item) {
                            $this->end_text_mob[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'steps_desc') {
                    if(!empty($ad->value)) {
                        $steps_desc = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($steps_desc as $k => $item) {
                            $this->steps_desc[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'steps_mob') {
                    if(!empty($ad->value)) {
                        $steps_mob = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($steps_mob as $k => $item) {
                            $this->steps_mob[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'recipe_amp') {
                    if(!empty($ad->value)) {
                        $recipe_amp = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($recipe_amp as $k => $item) {
                            $this->recipe_amp[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'recipe_mobile') {
                    if(!empty($ad->value)) {
                        $recipe_mobile = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($recipe_mobile as $k => $item) {
                            $this->recipe_mobile[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'recipe_desctop') {
                    if(!empty($ad->value)) {
                        $recipe_desctop = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($recipe_desctop as $k => $item) {
                            $this->recipe_desctop[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'rubrica_desctop') {
                    if(!empty($ad->value)) {
                        $rubrica_desctop = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($rubrica_desctop as $k => $item) {
                            $this->rubrica_desctop[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'rubrica_mobile') {
                    if(!empty($ad->value)) {
                        $rubrica_mobile = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($rubrica_mobile as $k => $item) {
                            $this->rubrica_mobile[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }

                if($ad->type == 'rubrica_amp') {
                    if(!empty($ad->value)) {
                        $rubrica_amp = json_decode(preg_replace("/[\r\n]+/", "???", $ad->value),true);
                        foreach ($rubrica_amp as $k => $item) {
                            $this->rubrica_amp[$k] = htmlspecialchars_decode(str_replace('???', '\n', $item));
                        }
                    }
                }
            }
        }
    }

    public function addRubricaDesctop()
    {
        $this->rubrica_desctop[] = [];
    }

    public function addRubricaMobile()
    {
        $this->rubrica_mobile[] = [];
    }

    public function addRubricaAmp()
    {
        $this->rubrica_amp[] = [];
    }

    public function saveReklama()
    {
        $additional_mob = [];
        if(!empty($this->additional_mob1)){
            $additional_mob[] = $this->additional_mob1;
        }
        if(!empty($this->additional_mob2)){
            $additional_mob[] = $this->additional_mob2;
        }

        $additional_mob = filter_mas($additional_mob);
        Ad::updateOrCreate([
            'type'   => 'additional_mob',
        ],[
            'type' => 'additional_mob',
            'value' => $additional_mob,
        ]);

        $rubrica2_desc = [];
        if(!empty($this->rubrica2_desc)){
            $rubrica2_desc = str_replace('\n', '', $this->rubrica2_desc);
        }

        $rubrica2_desc = filter_mas($rubrica2_desc);
        Ad::updateOrCreate([
            'type'   => 'rubrica2_desc',
        ],[
            'type' => 'rubrica2_desc',
            'value' => $rubrica2_desc,
        ]);

        $rubrica2_mob = [];
        if(!empty($this->rubrica2_mob)){
            $rubrica2_mob = str_replace('\n', '', $this->rubrica2_mob);
        }

        $rubrica2_mob = filter_mas($rubrica2_mob);
        Ad::updateOrCreate([
            'type'   => 'rubrica2_mob',
        ],[
            'type' => 'rubrica2_mob',
            'value' => $rubrica2_mob,
        ]);

        $end_text_desc = [];
        if(!empty($this->end_text_desc)){
            $end_text_desc = str_replace('\n', '', $this->end_text_desc);
        }

        $end_text_desc = filter_mas($end_text_desc);
        Ad::updateOrCreate([
            'type'   => 'end_text_desc',
        ],[
            'type' => 'end_text_desc',
            'value' => $end_text_desc,
        ]);

        $end_text_mob = [];
        if(!empty($this->end_text_desc)){
            $end_text_mob = str_replace('\n', '', $this->end_text_mob);
        }

        $end_text_mob = filter_mas($end_text_mob);
        Ad::updateOrCreate([
            'type'   => 'end_text_mob',
        ],[
            'type' => 'end_text_mob',
            'value' => $end_text_mob,
        ]);

        $steps_desc = [];
        if(!empty($this->steps_desc)){
            $steps_desc = str_replace('\n', '', $this->steps_desc);
        }

        $steps_desc = filter_mas($steps_desc);
        Ad::updateOrCreate([
            'type'   => 'steps_desc',
        ],[
            'type' => 'steps_desc',
            'value' => $steps_desc,
        ]);

        $steps_mob = [];
        if(!empty($this->steps_mob)){
            $steps_mob = str_replace('\n', '', $this->steps_mob);
        }

        $steps_mob = filter_mas($steps_mob);
        Ad::updateOrCreate([
            'type'   => 'steps_mob',
        ],[
            'type' => 'steps_mob',
            'value' => $steps_mob,
        ]);

        $recipe_amp = [];
        if(!empty($this->recipe_amp)){
            $recipe_amp = str_replace('\n', '', $this->recipe_amp);
        }

        $recipe_amp = filter_mas($recipe_amp);
        Ad::updateOrCreate([
            'type'   => 'recipe_amp',
        ],[
            'type' => 'recipe_amp',
            'value' => $recipe_amp,
        ]);

        $recipe_mobile = [];
        if(!empty($this->recipe_mobile)){
            $recipe_mobile = str_replace('\n', '', $this->recipe_mobile);
        }

        $recipe_mobile = filter_mas($recipe_mobile);
        Ad::updateOrCreate([
            'type'   => 'recipe_mobile',
        ],[
            'type' => 'recipe_mobile',
            'value' => $recipe_mobile,
        ]);

        $recipe_desctop = [];
        if(!empty($this->recipe_desctop)){
            $recipe_desctop = str_replace('\n', '', $this->recipe_desctop);
        }

        $recipe_desctop = filter_mas($recipe_desctop);
        Ad::updateOrCreate([
            'type'   => 'recipe_desctop',
        ],[
            'type' => 'recipe_desctop',
            'value' => $recipe_desctop,
        ]);

        $rubrica_desctop = [];
        if(!empty($this->rubrica_desctop)){
            $rubrica_desctop = str_replace('\n', '', $this->rubrica_desctop);
        }

        $rubrica_desctop = filter_mas($rubrica_desctop);
        Ad::updateOrCreate([
            'type'   => 'rubrica_desctop',
        ],[
            'type' => 'rubrica_desctop',
            'value' => $rubrica_desctop,
        ]);

        $rubrica_mobile = [];
        if(!empty($this->rubrica_mobile)){
            $rubrica_mobile = str_replace('\n', '', $this->rubrica_mobile);
        }

        $rubrica_mobile = filter_mas($rubrica_mobile);
        Ad::updateOrCreate([
            'type'   => 'rubrica_mobile',
        ],[
            'type' => 'rubrica_mobile',
            'value' => $rubrica_mobile,
        ]);

        $rubrica_amp = [];
        if(!empty($this->rubrica_amp)){
            $rubrica_amp = str_replace('\n', '', $this->rubrica_amp);
        }

        $rubrica_amp = filter_mas($rubrica_amp);
        Ad::updateOrCreate([
            'type'   => 'rubrica_amp',
        ],[
            'type' => 'rubrica_amp',
            'value' => $rubrica_amp,
        ]);

        session()->flash('success', "Данные рекламы успешно сохранены");
        $this->dispatch('hideAlert');
    }

    public function render()
    {
        return view('livewire.reklama.reklama');
    }
}
