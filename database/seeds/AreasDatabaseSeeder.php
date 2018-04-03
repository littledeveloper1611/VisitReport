<?php

use App\Area;
use Illuminate\Database\Seeder;

class AreasDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = new Area();
        $area->name = "Medan Amplas";
        $area->save();

        $area = new Area();
        $area->name = "Medan Area";
        $area->save();

        $area = new Area();
        $area->name = "Medan Barat";
        $area->save();

        $area = new Area();
        $area->name = "Medan Baru";
        $area->save();

        $area = new Area();
        $area->name = "Medan Belawan Kota";
        $area->save();

        $area = new Area();
        $area->name = "Medan Deli";
        $area->save();

        $area = new Area();
        $area->name = "Medan Denai";
        $area->save();

        $area = new Area();
        $area->name = "Medan Helvetia";
        $area->save();

        $area = new Area();
        $area->name = "Medan Johor";
        $area->save();

        $area = new Area();
        $area->name = "Medan Kota";
        $area->save();

        $area = new Area();
        $area->name = "Medan Labuhan";
        $area->save();

        $area = new Area();
        $area->name = "Medan Maimun";
        $area->save();

        $area = new Area();
        $area->name = "Medan Marelan";
        $area->save();

        $area = new Area();
        $area->name = "Medan Perjuangan";
        $area->save();

        $area = new Area();
        $area->name = "Medan Petisah";
        $area->save();

        $area = new Area();
        $area->name = "Medan Polonia";
        $area->save();

        $area = new Area();
        $area->name = "Medan Selayang";
        $area->save();

        $area = new Area();
        $area->name = "Medan Sunggal";
        $area->save();

        $area = new Area();
        $area->name = "Medan Tembung";
        $area->save();

        $area = new Area();
        $area->name = "Medan Timur";
        $area->save();

        $area = new Area();
        $area->name = "Medan Tuntungan";
        $area->save();
    }
}
