<?php
//000000000000s:324:"SELECT u.id,u.idmd5,u.jifen,u.sex,u.last_login_time,u.user_rank,u.user_nicename,u.avatar,u.age,u.provinceid,u.cityid,p.astro,p.monolog FROM lx_user_profile p INNER JOIN lx_users as u ON u.id=p.uid  WHERE ( u.sex =  2 and (u.= or u.cityid=0) ) ORDER BY u.ismj asc,u.user_rank desc,u.last_login_time desc,id desc LIMIT 30,15  ";
?>