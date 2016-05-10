<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use CategoryRepository;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkPermission:'.config('admin.permissions.category.list'), ['only' => ['index','sort']]);
        $this->middleware('checkPermission:'.config('admin.permissions.category.create'), ['only' => ['store']]);
        $this->middleware('checkPermission:'.config('admin.permissions.category.edit'), ['only' => ['edit', 'update']]);
        $this->middleware('checkPermission:'.config('admin.permissions.category.destory'), ['only' => ['destroy']]);
    }
	/**
	 * 分类首页
	 * @date   2016-05-05
	 * @author 晚黎
	 * @return [type]     [description]
	 */
    public function index()
    {
    	$cate = CategoryRepository::index();
    	return view('admin.cate.list')->with(compact('cate'));
    }
    /**
     * 修改分类数据视图
     * @date   2016-05-05
     * @author 晚黎
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function edit($id)
    {
    	$category = CategoryRepository::edit($id);
    	return response()->json($category);
    }
    /**
     * 修改分类
     * @date   2016-05-05
     * @author 晚黎
     * @param  CategoryRequest $request [description]
     * @param  [type]          $id      [description]
     * @return [type]                   [description]
     */
    public function update(CategoryRequest $request,$id)
    {
    	CategoryRepository::update($request,$id);
    	return redirect('admin/cate');
    }
    /**
     * 添加分类
     * @date   2016-05-05
     * @author 晚黎
     * @param  CategoryRequest $request [description]
     * @return [type]                   [description]
     */
    public function store(CategoryRequest $request)
    {
    	CategoryRepository::store($request);
    	return redirect('admin/cate');
    }
    /**
     * 分类排序
     * @date   2016-05-05
     * @author 晚黎
     * @return [type]     [description]
     */
    public function sort()
    {
    	$result = CategoryRepository::sort();
    	return response()->json($result);
    }

    /**
     * 删除分类
     * @date   2016-05-05
     * @author 晚黎
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function destroy($id)
    {
    	CategoryRepository::destroy($id);
    	return redirect('admin/cate');
    }
}
