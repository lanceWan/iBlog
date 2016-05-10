<?php 
namespace App\Repositories\front;
use Illuminate\Pagination\BootstrapThreePresenter;
/**
* 自定义分页
*/
class PaginationRepository extends BootstrapThreePresenter
{
	public function render()
    {
        if ($this->hasPages())
        {
            return sprintf(
                '<div class="paginations-v2 text-center"><ul class="paginations-v2-list">%s %s %s</ul></div>',
                $this->getPreviousButton('Prev'),
                $this->getLinks(),
                $this->getNextButton('Next')
            );
        }
 
        return '';
    }

    /**
     * 自定义上一页和下一页按钮禁用样式
     * @author 晚黎
     * @date   2016-05-10T11:06:31+0800
     * @param  [type]                   $text [description]
     * @return [type]                         [description]
     */
    protected function getDisabledTextWrapper($text,$bool = true)
    {
    	if ($bool) {
	        return '<li class="disabled"><span>'.$text.'</span></li>';
    	}
        $className = $text == 'Prev' ? 'previous':'next';
    	return '<li class="'.$className.'  disabled"><span aria-label="'.$className.'"><span aria-hidden="true">'.$text.'</span></span></li>';
    }
    /**
     * 自定义上一页和下一页按钮样式
     * @author 晚黎
     * @date   2016-05-10T11:22:34+0800
     * @param  [type]                   $url  [description]
     * @param  [type]                   $page [description]
     * @param  [type]                   $rel  [description]
     * @param  boolean                  $bool [description]
     * @return [type]                         [description]
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $str = $rel == 'prev' ? 'previous':'next';
        if ($rel) {
	        return '<li class="'.$str.'"><a href="'.htmlentities($url).'" aria-label="Next"><span aria-hidden="true">'.$page.'</span></a></li>';
        }
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';
        return '<li><a href="'.htmlentities($url).'"'.$rel.'>'.$page.'</a></li>';

    }

    /**
     * 重写 BootstrapThreeNextPreviousButtonRendererTrait 上一页按钮
     * @author 晚黎
     * @date   2016-05-10T11:07:41+0800
     * @param  string                   $text [description]
     * @return [type]                         [description]
     */
    public function getPreviousButton($text = '&laquo;')
    {
        // If the current page is less than or equal to one, it means we can't go any
        // further back in the pages, so we will render a disabled previous button
        // when that is the case. Otherwise, we will give it an active "status".
        if ($this->paginator->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text,false);
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text, 'prev');
    }

    public function getNextButton($text = '&raquo;')
    {
        // If the current page is greater than or equal to the last page, it means we
        // can't go any further into the pages, as we're already on this last page
        // that is available, so we will make it the "next" link style disabled.
        if (! $this->paginator->hasMorePages()) {
            return $this->getDisabledTextWrapper($text,false);
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text, 'next');
    }

    /**
     * 重写 UrlWindowPresenterTrait 中 getPageLinkWrapper 方法,让上一页下一页样式不一样
     * @author 晚黎
     * @date   2016-05-10T11:18:49+0800
     * @param  [type]                   $url  [description]
     * @param  [type]                   $page [description]
     * @param  [type]                   $rel  [description]
     * @return [type]                         [description]
     */
    protected function getPageLinkWrapper($url, $page, $rel = null)
    {
        if ($page == $this->paginator->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page, $rel);
    }
}