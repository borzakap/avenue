<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of PagesTranslationsClass
 *
 * @author alexey
 */
class PagesTranslationsController extends BaseController{

    protected $helpers = ['form'];
    
    // existing pages
    protected $pages = [
        'home',
        'contact',
        'common',
    ];

    public function update(string $slug){
        if(!in_array($slug, $this->pages)){
            throw new PageNotFoundException($slug);
        }
        $model = model(PagesTranslationsModel::class);
        if($this->request->getMethod() == 'post'){
            if($model->updateTranslations($this->request->getPost(), $slug)){
                return redirect()->route('page_update', [$slug])->with('message', lang('Pages.Messages.TranslationUpdate'));
            }else{
                return redirect()->back()->withInput()->with('error', lang('Pages.Errors.TranslationUpdate'));
            }
        }
        $config = config(App::class);
        $rows = $model->getTranslations($slug);
        $this->breadcrumb->add(lang('Pages.Admin.PagesUpdate', ['page_name'=>$slug]), '/admin/pages/update');
        $data = [
            'form' => '_'.$slug,
            'languages' => $config->supportedLocales,
            'default_naguage' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        $transpations = [];
        foreach ($rows as $row){
            $transpations['translation'][$row->language][$row->code] = $row->text;
        }
        $data['data'] = $transpations;
        return view('admin/pages/update', $data);
    }
    
}
