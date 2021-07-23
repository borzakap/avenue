<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use CodeIgniter\Database\Exceptions\DataException;
/**
 * Description of LayoutsController
 *
 * @author alexey
 */
class LayoutsController extends BaseController {

    protected $helpers = ['form','html'];

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
            if (($id = $model->updateLayout($id, $this->request->getPost()))) {
                return redirect()->route('layout_update', [$id])->with('message', lang('Layouts.Messages.Messages.Insertatiton'));
            }
            return redirect()->back()->withInput()->with('error', lang('Layouts.Messages.Error.Updating'));
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
            'data' => $model->find($id)->withTranslations()->withFloorImage(),
            'layout_id' => $id,
        ];
        return view('admin/layouts/update', $data);
    }

    public function poligonSave() {

        $return = [
            'success' => false,
            'message' => lang('Layout.Messages.Error.UndefinedError'),
        ];
        if (!$this->request->getMethod() === 'post') {
            $return['message'] = lang('Sections.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }

        $layout_id = $this->request->getPost('layout_id');

        $model = model(LayoutsModel::class);
        $layout = $model->find($layout_id);
        
        $layout->poligon = $this->request->getPost('poligon');

        // upload image_2d
        $validate_image_2d = $this->validate([
            'image_2d' => 'uploaded[image_2d]|mime_in[image_2d,image/png,image/jpg,image/jpeg]'
        ]);
        if ($validate_image_2d) {
            $image_2d = $this->request->getFile('image_2d');
            if ($image_2d->isValid() && !$image_2d->hasMoved()) {
                if ($layout->image_2d && file_exists(IMGPATH . 'layouts/' . $layout->image_2d)){
                    unlink(IMGPATH . 'layouts/' . $layout->image_2d);  
                }
                $layout->image_2d = $image_2d->getName();
                $image_2d->move(IMGPATH . 'layouts', $image_2d->getName(), true);
            }
        }

        // upload image_2d
        $validate_image_3d = $this->validate([
            'image_3d' => 'uploaded[image_3d]|mime_in[image_3d,image/png,image/jpg,image/jpeg]'
        ]);
        if ($validate_image_3d) {
            $image_3d = $this->request->getFile('image_3d');
            if ($image_3d->isValid() && !$image_3d->hasMoved()) {
                if ($layout->image_3d && file_exists(IMGPATH . 'layouts/' . $layout->image_3d)){
                    unlink(IMGPATH . 'layouts/' . $layout->image_3d);  
                }
                $layout->image_3d = $image_3d->getName();
                $image_3d->move(IMGPATH . 'layouts', $image_3d->getName(), true);
            }
        }

        // upload file_to_upload
        $validate_file_to_upload = $this->validate([
            'file_to_upload' => 'uploaded[file_to_upload]|mime_in[file_to_upload,image/png,image/jpg,image/jpeg]'
        ]);
        if ($validate_file_to_upload) {
            $file_to_upload = $this->request->getFile('file_to_upload');
            if ($file_to_upload->isValid() && !$file_to_upload->hasMoved()) {
                if ($layout->file_to_upload && file_exists(IMGPATH . 'layouts/' . $layout->file_to_upload)){
                    unlink(IMGPATH . 'layouts/' . $layout->file_to_upload);  
                }
                $layout->file_to_upload = $file_to_upload->getName();
                $file_to_upload->move(IMGPATH . 'layouts', $file_to_upload->getName(), true);
            }
        }
        // saving data
        try{
            $model->save($layout);
            $return['success'] = true;
            $return['message'] = lang('Layouts.Messages.Success.Updated');
        } catch (DataException $e) {
            $return['message'] = $e->getMessage();
        }

        return $this->response->setJSON($return);
    }
    
    public function poligonChange(){
        $return = [
            'success' => false,
            'message' => lang('Layouts.Messages.Error.UndefinedError'),
            'image' => false,
        ];
        if (!$this->request->getMethod() === 'post') {
            $return['message'] = lang('Layouts.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        
        $floor_images_id = $this->request->getPost('floor_images_id');

        $model = model(LayoutsModel::class);
        $image = $model->getImageFloor($floor_images_id);
        if(isset($image->image_name) && $image->image_name){
            $return['success'] = true;
            $return['image'] = base_url('images/sections/'.$image->image_name);
        }
        return $this->response->setJSON($return);
        
    }

}
