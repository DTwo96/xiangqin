<?php
namespace Admin\Model;
/**
 * 后台菜单
 */
class MenuModel {
	/**
     * 获取所有菜单
     */
	public function getMenu($loginUserInfo = array()){
        if(!empty($loginUserInfo)){
            $menuPurview = unserialize($loginUserInfo['menu_purview']);
        }
		$list = getAllService('Menu','Admin');
		//合并菜单
        foreach ($list as $value) {
            $menu=array_merge_recursive((array)$menu,(array)$value);
        }
        unset($menu['index']['menu'][1]);
        unset($menu['Form']['menu'][0]);
        unset($menu['Content']['menu'][1]);
        //排序菜单
        foreach ((array) $menu as $topKey => $top) {
            if (!empty($top['menu']) && is_array($top['menu'])) {    
                if(!empty($menuPurview)&&$top['menu']&&$loginUserInfo['user_id']<>1){
                    $subMenu = array();            
                    foreach ($top['menu'] as $vo) {
                        if(in_array($top['name'].'_'.$vo['name'], $menuPurview)){
                            $subMenu[] = $vo;
                        }
                    }
                    $top['menu'] = $subMenu;
                }
                $menu[$topKey]['menu'] = array_order($top['menu'], 'order', 'asc');
            }
        }

        $menu['index']['menu'][1]['name'] = '系统首页';
        $menu=array_order($menu, 'order', 'asc');
        return $menu;
	}
    /**
     * 获取所有操作
     */
    public function getPurview(){
        $list = getAllService('Purview','Admin');
        if(empty($list)){
            return $list;
        }
        return $list;
    }
}