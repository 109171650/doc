Git中保存用户名和密码

每次操作都需要输入用户名和密码感觉很繁琐，解决方法，在本地的工程文件夹的.git下打开config文件
添加：

    [credential]
         helper = store

再输入一次用户名密码后就可以保存住了。


git config --global user.email "109171650@qq.com"
git config --global user.name "109171650@qq.com"

//查看远程库地址
git remote  -v

//但行查看版本
git log --pretty=oneline

//查看分支
git branch
//创建分支
git branch xxx
//切换分支
git checkout xxx

git reflog

//切换版本
git reset --hard HEAD^
