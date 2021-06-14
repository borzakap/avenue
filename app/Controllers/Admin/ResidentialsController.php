<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use App\Models\ResidentialsModel;

class ResidentialsController extends BaseController {

    protected $helpers = ['form'];
    
    /**
     * list of residentials
     * @return type
     */
    public function list() {
        $model = model(ResidentialsModel::class);
        $items = $model->getResidentials($this->request->getLocale());
        $this->breadcrumb->add(lang('Residentials.Breadcrumb.Admin.Residentials'), '/admin/residentials');
        $data = [
            'items' => $items,
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/residentials/list', $data);
    }

    /**
     * create residential
     * @return type
     */
    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $config = config(App::class);
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Residentials'), '/admin/residentials');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.ResidentialCreate'), '/admin/residentials/create');

            $data = [
                'languages' => $config->supportedLocales,
                'default_naguage' => $config->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
            ];
            return view('admin/residentials/create', $data);
        }
        $model = model(ResidentialsModel::class);
        if (($id = $model->createResidential($this->request->getPost()))) {
            return redirect()->route('residential_update', [$id])->with('message', lang('Residentials.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Residentials.Messages.Error.Insertatiton'));
    }

    /**
     * update residential
     * @param int $id
     * @return type
     */
    public function update(int $id) {
        $model = model(ResidentialsModel::class);
        $config = config(App::class);
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Residentials'), '/admin/residentials');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.ResidentialUpdate'), '/admin/residentials/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            
        }
        $data = [
            'languages' => $config->supportedLocales,
            'default_naguage' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'data' => $model->find($id)->withTranslations(),
        ];
        return view('admin/residentials/update', $data);
    }
    
    public function delete(int $id){
        
    }

}
