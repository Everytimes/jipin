<?php
if (!defined('IN_HHS'))
{
    die('Hacking attempt');
}

/**

 * 根据属性数组创建属性的表单

 *

 * @access  public

 * @param   int     $cat_id     分类编号

 * @param   int     $goods_id   商品编号

 * @return  string

 */

function build_attr_html($cat_id, $goods_id = 0)

{

    $attr = get_attr_list($cat_id, $goods_id);

    $html = '<table width="40%" id="attrTable">';

    $spec = 0;



    foreach ($attr AS $key => $val)

    {

        $html .= "<tr><td class='label'>";

        if ($val['attr_type'] == 1 || $val['attr_type'] == 2)

        {

            $html .= ($spec != $val['attr_id']) ?

                "<a href='javascript:;' onclick='addSpec(this)'>[+]</a>" :

                "<a href='javascript:;' onclick='removeSpec(this)'>[-]</a>";

            $spec = $val['attr_id'];

        }



        $html .= "$val[attr_name]</td><td><input type='hidden' class='input' name='attr_id_list[]' value='$val[attr_id]' />";



        if ($val['attr_input_type'] == 0)

        {

            $html .= '<input name="attr_value_list[]" class="input" type="text" value="' .htmlspecialchars($val['attr_value']). '" size="40" /> ';

        }

        elseif ($val['attr_input_type'] == 2)

        {

            $html .= '<textarea name="attr_value_list[]" rows="3" cols="40">' .htmlspecialchars($val['attr_value']). '</textarea>';

        }

        else

        {

            $html .= '<select name="attr_value_list[]">';

            $html .= '<option value="">请选择...</option>';



            $attr_values = explode("\n", $val['attr_values']);



            foreach ($attr_values AS $opt)

            {

                $opt    = trim(htmlspecialchars($opt));



                $html   .= ($val['attr_value'] != $opt) ?

                    '<option value="' . $opt . '">' . $opt . '</option>' :

                    '<option value="' . $opt . '" selected="selected">' . $opt . '</option>';

            }

            $html .= '</select> ';

        }



        /*$html .= ($val['attr_type'] == 1 || $val['attr_type'] == 2) ?

            '属性价格'.' <input type="text" name="attr_price_list[]" class="input" value="' . $val['attr_price'] . '" size="5" maxlength="10" />' :

            ' <input type="hidden" name="attr_price_list[]" value="0" />';*/



        $html .= '</td></tr>';

    }



    $html .= '</table>';



    return $html;

}





/**

 * 取得通用属性和某分类的属性，以及某商品的属性值

 * @param   int     $cat_id     分类编号

 * @param   int     $goods_id   商品编号

 * @return  array   规格与属性列表

 */

function get_attr_list($cat_id, $goods_id = 0)

{

    if (empty($cat_id))

    {

        return array();

    }



    // 查询属性值及商品的属性值

    $sql = "SELECT a.attr_id, a.attr_name, a.attr_input_type, a.attr_type, a.attr_values, v.attr_value, v.attr_price ".

            "FROM " .$GLOBALS['hhs']->table('attribute'). " AS a ".

            "LEFT JOIN " .$GLOBALS['hhs']->table('goods_attr'). " AS v ".

            "ON v.attr_id = a.attr_id AND v.goods_id = '$goods_id' ".

            "WHERE a.cat_id = " . intval($cat_id) ." OR a.cat_id = 0 ".

            "ORDER BY a.sort_order, a.attr_type, a.attr_id, v.attr_price, v.goods_attr_id";



    $row = $GLOBALS['db']->GetAll($sql);



    return $row;

}


/**
 * 取得重量单位列表
 * @return  array   重量单位列表
 */
function get_unit_list()
{
    return array(
        '1'     => '千克',
        '0.001' => '克',
    );
}




?>