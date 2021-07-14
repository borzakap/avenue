<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description of LayoutsController
 *
 * @author alexey
 */
class LayoutsController extends BaseController {

    protected $helpers = ['form'];

    public function list() {
        $model = model(LayoutsModel::class);
        $items = $model->getLayouts($this->request->getLocale());
        $this->breadcrumb->add(lang('Residentials.Breadcrumb.Admin.Residentials'), '/admin/residentials');
        $data = [
            'items' => $items,
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/layouts/list', $data);
    }

    public function create() {
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $config = config(App::class);
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Layouts'), '/admin/layouts');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.LayoutsCreate'), '/admin/layouts/create');
            $residentials = model(ResidentialsModel::class);
            $sections = model(SectionsModel::class);
            $floors = model(FloorsImagesModel::class);

            $data = [
                'languages' => $config->supportedLocales,
                'default_language' => $config->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => $residentials->getResidentialsList($config->defaultLocale),
                'sections' => $sections->getSectionsList($config->defaultLocale),
                'floors' => $floors->getFloorsList(),
            ];
            return view('admin/layouts/create', $data);
        }
        $model = model(LayoutsModel::class);
        if (($id = $model->createLayout($this->request->getPost()))) {
            return redirect()->route('layout_update', [$id])->with('message', lang('Layouts.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Layouts.Messages.Error.Insertatiton'));
    }

    public function update(int $id) {
        $model = model(LayoutsModel::class);
        $config = config(App::class);
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Layouts'), '/admin/layouts');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionUpdate'), '/admin/layouts/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            
        }
        $residentials = model(ResidentialsModel::class);
        $sections = model(SectionsModel::class);
        $floors = model(FloorsImagesModel::class);
        $data = [
            'languages' => $config->supportedLocales,
            'default_language' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => $residentials->getResidentialsList($config->defaultLocale),
            'sections' => $sections->getSectionsList($config->defaultLocale),
            'floors' => $floors->getFloorsList(),
            'data' => $model->find($id)->withTranslations(),
            'layout_id' => $id,
        ];
        return view('admin/layouts/update', $data);
    }

    public function poligonSave() {

        $return = [
            'success' => false,
            'message' => lang('Layout.Messages.Error.UndefinedError'),
            'data' => false,
        ];
        if (!$this->request->getMethod() === 'post') {
            $return['message'] = lang('Sections.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        $return['success'] = true;
        $return['data'] = $this->request->getPost();

        // upload files first
        $validate_image_2d = $this->validate([
            'image_2d' => 'uploaded[image_2d]|mime_in[image_2d,image/png,image/jpg,image/jpeg]'
        ]);
        if ($validate_image_2d) {
            $image_2d = $this->request->getFile('image_2d');
            $return['data']['files']['image_2d'] = $image_2d->getName();
        }

        $validate_image_3d = $this->validate([
            'image_3d' => 'uploaded[image_3d]|mime_in[image_3d,image/png,image/jpg,image/jpeg]'
        ]);
        if ($validate_image_3d) {
            $image_3d = $this->request->getFile('image_3d');
            $return['data']['files']['image_3d'] = $image_3d->getName();
        }
        $validate_file_to_upload = $this->validate([
            'file_to_upload' => 'uploaded[file_to_upload]|mime_in[file_to_upload,image/png,image/jpg,image/jpeg]'
        ]);
        if ($validate_file_to_upload) {
            $file_to_upload = $this->request->getFile('file_to_upload');
            $return['data']['files']['file_to_upload'] = $file_to_upload->getName();
        }


//        $return['data']['files'] = $files;


        return $this->response->setJSON($return);
    }

}
