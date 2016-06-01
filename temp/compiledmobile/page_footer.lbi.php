
<footer class="footer c-footer ">
<section class="footer-t c-footer-t">
<p class="user-info c-user-info">
<span><a id="J_footer_login" href="user.php"><?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></a></span><span><a href="user.php?act=register">注册</a></span>
</p>
<p class="gotop c-gotop">
<a id="J_GoTop" href="javascript:scroll(0,0)">top<b> </b></a></p>
</section>
<nav class="footer-l c-footer-l">
<A id=btn_go_pc href="index.php?pid=<?php echo $this->_var['sid']; ?>">电脑版</a>
<a id="J_imgViewType" href="javascript:void(0)" class="J_dps" data-dps="hdedition%23h%23" style="display:none;"></a>
</nav>
<p class="copyright c-copyright"><?php echo $this->_var['copyright']; ?></p>
 
</footer>
 

