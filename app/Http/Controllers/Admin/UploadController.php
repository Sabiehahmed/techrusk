<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\UploadsManager;

use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UploadNewFolderRequest;

class UploadController extends Controller
{
    /**
     * @var UploadsManager
     */
    protected $manager;


    /**
     *
     * UploadController constructor.
     * @param UploadsManager $manager
     */
    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * SHow upload manages
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        return view('admin.upload.index', $data);
    }


    /**
     * Creates folder
     * @param UploadNewFolderRequest $request
     * @return mixed
     */
    public function createFolder(UploadNewFolderRequest $request)
    {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder') . '/' . $new_folder;

        $result = $this->manager->createDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->withSuccess("Folder '$new_folder' created.");
        }

        $error = $result ?: "An error occurred creating directory.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }

    /**
     * Deletes file
     * @param Request $request
     * @return mixed
     */
    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder') . '/' . $del_file;

        $result = $this->manager->deleteFile($path);

        if ($result === true) {
            return redirect()
                ->back()
                ->withSuccess("File '$del_file' deleted.");
        }

        $error = $result ?: "An error occurred deleting file.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }


    /**
     * Deletes a folder
     * @param Request $request
     * @return mixed
     */
    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder') . '/' . $del_folder;

        $result = $this->manager->deleteDirectory($folder);

        if ($result === true) {
            return redirect()
                ->back()
                ->withSuccess("Folder '$del_folder' deleted.");
        }

        $error = $result ?: "An error occurred deleting directory.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }

    /**
     * Uploads a file
     * @param UploadFileRequest $request
     * @return mixed
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        $fileCounts = intval($data['fileCounts']) + 1;

        $fileName = $request->get('file_name');
        $fileName = $fileName ?: \Carbon\Carbon::now()->toDateString() . '-' . $fileCounts . '-' . $file['name'];

        //Lower case everything
        $fileName = strtolower($fileName);
        //Clean up multiple dashes or whitespaces
        $fileName = preg_replace("/[\s-]+/", " ", $fileName);
        //Convert whitespaces and underscore to dash
        $fileName = preg_replace("/[\s_]/", "-", $fileName);

        $fileName = preg_replace('/[ ,]+/', '-', trim($fileName));

        $fileName = preg_replace('/[ $]+/', '-', trim($fileName));

        $fileName = preg_replace('/[ &]+/', '-', trim($fileName));

        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = file_get_contents($file['tmp_name']);

        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            return redirect()
                ->back()
                ->withSuccess("File '$fileName' uploaded.");
        }

        $error = $result ?: "An error occurred uploading file.";
        return redirect()
            ->back()
            ->withErrors([$error]);
    }


    /**
     * Generates file url
     * @param UploadFileRequest $request
     * @return mixed
     */
    public function uploadFile_url(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        $fileCounts = intval($data['fileCounts']) + 1;

        $fileName = $request->get('file_name');
        $fileName = $fileName ?: \Carbon\Carbon::now()->toDateString() . '-' . $fileCounts . '-' . $file['name'];

        //Lower case everything
        $fileName = strtolower($fileName);
        //Clean up multiple dashes or whitespaces
        $fileName = preg_replace("/[\s-]+/", " ", $fileName);
        //Convert whitespaces and underscore to dash
        $fileName = preg_replace("/[\s_]/", "-", $fileName);

        $fileName = preg_replace('/[ ,]+/', '-', trim($fileName));


        $fileName = preg_replace('/[ $]+/', '-', trim($fileName));

        $fileName = preg_replace('/[ &]+/', '-', trim($fileName));


        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = file_get_contents($file['tmp_name']);

        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            return response()->json(['url' => "/media" . $path]);
        } else {
            $error = $result ?: "An error occurred uploading file.";
            return response()->json(['url' => null], 422);

        }


    }


    /**
     * Returns uploaded file path file path
     * @param UploadFileRequest $request
     * @return mixed
     */
    public function uploadFile_path(UploadFileRequest $request)
    {


        $file = $_FILES['file'];
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        $fileCounts = intval($data['fileCounts']) + 1;

        $fileName = $request->get('file_name');
        $fileName = $fileName ?: \Carbon\Carbon::now()->toDateString() . '-' . $fileCounts . '-' . $file['name'];
        //Lower case everything
        $fileName = strtolower($fileName);
        //Clean up multiple dashes or whitespaces
        $fileName = preg_replace("/[\s-]+/", " ", $fileName);
        //Convert whitespaces and underscore to dash
        $fileName = preg_replace("/[\s_]/", "-", $fileName);

        $fileName = preg_replace('/[ ,]+/', '-', trim($fileName));


        $fileName = preg_replace('/[ $]+/', '-', trim($fileName));

        $fileName = preg_replace('/[ &]+/', '-', trim($fileName));

        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = file_get_contents($file['tmp_name']);

        $result = $this->manager->saveFile($path, $content);

        if ($result === true) {
            return response()->json(['url' => "/media" . $path]);
        } else {
            $error = $result ?: "An error occurred uploading file.";
            return response()->json(['url' => null], 422);

        }


    }
}
