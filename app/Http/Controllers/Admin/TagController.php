<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use TagRepository;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPermission:'.config('admin.permissions.tag.list'), ['only' => ['index', 'ajaxIndex']]);
        $this->middleware('checkPermission:'.config('admin.permissions.tag.create'), ['only' => ['create', 'store']]);
        $this->middleware('checkPermission:'.config('admin.permissions.tag.edit'), ['only' => ['edit', 'update']]);
        $this->middleware('checkPermission:'.config('admin.permissions.tag.destory'), ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('admin.tag.list');
    }

    /**
     *
     * datatable获取数据
     * 
     * @date   2016-05-06
     * @author 晚黎
     * @return [type]     [description]
     */
    public function ajaxIndex()
    {
        $data = TagRepository::ajaxIndex();
        return response()->json($data);
    }
    /**
     * 添加标签视图
     * @date   2016-05-06
     * @author 晚黎
     * @return [type]     [description]
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * 添加标签
     * @date   2016-05-06
     * @author 晚黎
     * @param  TagRequest $request [description]
     * @return [type]                     [description]
     */
    public function store(TagRequest $request)
    {
        TagRepository::store($request);
        return redirect('admin/tag');
    }

    /**
     * 修改标签视图
     * @date   2016-05-06
     * @author 晚黎
     * @param  [type]     $id [description]
     * @return [type]         [description]
     */
    public function edit($id)
    {
    	$tag = TagRepository::edit($id);
        return view('admin.tag.edit')->with(compact('tag'));
    }
    /**
     * 修改标签信息
     * @date   2016-05-06
     * @author 晚黎
     * @param  TagRequest $request [description]
     * @param  [type]     $id      [description]
     * @return [type]              [description]
     */
    public function update(TagRequest $request,$id)
    {
        TagRepository::update($request,$id);
        return redirect('admin/tag');
    }

    /**
     * 删除标签
     * @author 晚黎
     * @date   2016-04-14T11:52:40+0800
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function destroy($id)
    {
        TagRepository::destroy($id);
        return redirect('admin/tag');
    }
}
