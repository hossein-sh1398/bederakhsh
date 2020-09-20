<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Module;

class ModuleController extends Controller
{
   public function index()
   {
        $modules = Module::all();

        return view('main::Admin.all', ['modules' => $modules]);
   }

   public function disable($name)
   {
        $module = Module::find($name);
        $module->disable();

        return back();
   }

   public function enable($name)
   {
        $module = Module::find($name);
        $module->enable();

        return back();
   }

   public function delete($name)
   {
        $module = Module::find($name);
        $module->delete();

        return back();
   }
}
