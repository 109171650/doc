http://music.163.com/#/download
1、将.deb格式的这个包里面的data/usr文件夹解压出来，其余的无用

2、将usr里面的文件对应着目录移到系统中/usr文件夹中下
sudo mv ~/Downloads/usr/bin/netease-cloud-music /usr/bin
sudo mv ~/Downloads/usr/lib/netease-cloud-music /usr/lib
sudo mv ~/Downloads/usr/share/applications/netease-cloud-music.desktop /usr/share/applications/
sudo mv ~/Downloads/usr/share/doc/netease-cloud-music /usr/share/doc
sudo mv ~/Downloads/usr/share/icons/hicolor/scalable/apps/netease-cloud-music.svg    /usr/share/icons/hicolor/scalable/apps

3、将图标改成网易云音乐的
定位到/usr/share/applications/ 中，打开那个快捷方式，就可以了，
用记事本打开，将图标改成网易云音乐的
Icon=/usr/share/icons/hicolor/scalable/apps/netease-cloud-music.svg

4.加音视频解码器，不然会报网络错误
su -c 'dnf install http://download1.rpmfusion.org/free/fedora/rpmfusion-free-release-$(rpm -E %fedora).noarch.rpm http://download1.rpmfusion.org/nonfree/fedora/rpmfusion-nonfree-release-$(rpm -E %fedora).noarch.rpm'
sudo dnf install gstreamer1-libav gstreamer1-plugins-ugly gstreamer1-plugins-bad-free gstreamer1-plugins-bad-freeworld gstreamer1-vaapi
sudo dnf install libmad

5.加两条命令
sudo dnf install qt5-qtx11extras
sudo dnf install qt5-qtmultimedia
