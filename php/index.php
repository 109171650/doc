<!DOCTYPE HTML>
<html>
<body>

<?php
define('ROOT_PATH',substr(dirname(__FILE__),13).'/'); //定义站点目录
echo ROOT_PATH;

 function read_all_dir ( $dir = './' )
    {
        $result = array(); // 存放查找出的数组用
        $handle = opendir($dir);// 获得指定目录文件资源句柄

        if ( $handle ) // 如果句柄为真
        {
            while ( ( $file = readdir ( $handle ) ) !== false )
            {
                if ( $file != '.' && $file != '..' && $file != '.git')
                {
                    $cur_path = $dir . DIRECTORY_SEPARATOR . $file;
                    if ( is_dir ( $cur_path ) )
                    {
                        $result['dir'][$cur_path] = read_all_dir ( $cur_path );
                    }else{
                      $cur_path = substr($cur_path,3); // 去除开头的 './/'
                      // $cur_path = "<a href='".ROOT_PATH.'/'.$cur_path."' >".$cur_path."</a>";
                      // $cur_path = "<a href='".file_get_contents(ROOT_PATH.'/'.$cur_path)."' >".$cur_path."</a>";
                      echo file_get_contents(__FILE__.$cur_path);die;
                      // echo __FILE__.$cur_path;die;
                      $cur_path = "<a href='".ROOT_PATH.'/'.$cur_path."' >".$cur_path."</a>";
                        $result['file'][] = $cur_path;
                    }
                }
            }
            closedir($handle);
        }
        return $result;
    }
$dir = read_all_dir();
var_dump($dir['dir']);
?>


<style>
html,body{
  padding:0px;
  marign:0px;
  background-color: yellow;
}
.container{
  margin:0px auto;
  min-width:480px;
  max-width:1129px;
  height: auto;
  border: 1px solid red;
  background-color: gray;
}
.header{
  height:100px;
  background-color: green;
  clear:both;
}
.content{
  min-height:500px;
  background-color: blue;
  clear:both;
}
.left{
  padding:20px;
  width:200px;
  min-height:500px;
  background-color: gray;
}
.footer{
  height:100px;
  background-color: green;
  clear:both;
}
</style>

<div class="container">
  <header class="header">
  </header>
  <div class="content">
      <div class="left">
        <?php
            foreach ($dir as $k => $v)
            {
              print_r($k);
              echo '<br>';
            }
        ?>
      </div>
  </div>
<footer class="header">
</footer>
</div>
</body>
</html>
