<?php
namespace App\Http\Controllers\Category;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\ImageRepository;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $images = $this->imageRepository->getAll();
        return view('Categories.Image',['images'=>$images]);
    }
    public function uploadImage(Request $req){
        $file = $req->all()['file'];
        Storage::disk('local')->put('public/',$file);
        var_dump($req->all());die('1');
    }
}
