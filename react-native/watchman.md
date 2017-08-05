vi ~/.profile
#Android Environment
export ANDROID_HOME=~/Android/sdk

#Java env
export JAVA_HOME=/usr/lib/jvm/java-1.8.0-openjdk-amd64
export CLASSPATH=$CLASSPATH:$JAVA_HOME/lib:$JAVA_HOME/jre/lib

export PATH=$PATH:$JAVA_HOME/bin:$JAVA_HOME/jre/bin:$ANDROID_HOME/tools:$ANDROID_HOME/platform-tools
关于Android SDK的一些要求

官方说一定要装build tools 23.0.1，但是笔者那天网络不好，偏偏下载不下这个版本。怎么办，编译工程直接报错。
于是笔者修改了工程中build.gradle文件中到相关配置选项buildToolsVersion "23.0.1"，修改成你当前sdk包里面已有的版本，比如25.0.1。
之所以官方说要23.0.1是因为初始化工程的时候默认配置是这个。
minSdkVersion 16，在build.gradle中一定注意这个，16是facebook支持到最小api，切记切记！笔者到工程又一次因为是15，半天没查处原因。
关于效率的一些做法

初始化工程之前务必添加淘宝镜像源，不然你就准备等半天吧，有时还会因为timeout导致失败。具体的，在终端执行

npm config set registry https://registry.npm.taobao.org
然后检查是否设置成功：

npm config list
然后再初始化工程：

react-native init MyProject
运行工程之前，把gradle离线到本地并引用，不然比上一步还慢！具体做法是打开项目工程下gradle/wrapper/gradle-wrapper.properties这个文件，查看distributionUrl这个值是那个gradle的版本，然后去这个链接，把相应到版本下载到本地，比如说home/phoobobo/gradle/gradle-2.4-all.zip这个路径，那么你修改distributionUrl这个值distributionUrl=file:///home/phoobobo/gradle/gradle-2.4-all.zip。
执行完上述操作再通过终端命令react-native run-android运行工程或者在android studio直接运行工程，会很快。
必须安装watchman！

必须安装watchman！必须安装watchman！必须安装watchman！重要的事情说三遍！我就因为没有安装watchman后面浪费到时间不计其数，虽然临时用其他办法解决了，但是最终卡在这里过不去了。
如果不装，经常会出现这样到问题：

watch /home/boolean/Workspace/react-native-TIMMangaerDemo_android/android/sdklibrary/build/intermediates/rs/androidTest/debug ENOSPC
{"code":"ENOSPC","errno":"ENOSPC","syscall":"watch /home/boolean/Workspace/react-native-TIMMangaerDemo_android/android/sdklibrary/build/intermediates/rs/androidTest/debug","filename":"/home/boolean/Workspace/react-native-TIMMangaerDemo_android/android/sdklibrary/build/intermediates/rs/androidTest/debug"}
Error: watch /home/boolean/Workspace/react-native-TIMMangaerDemo_android/android/sdklibrary/build/intermediates/rs/androidTest/debug ENOSPC
at exports._errnoException (util.js:911:11)
.......
有没有发现里面好多“watch”？开始我是通过删除build目录，重新build工程，问题有很多次得到解决，后面就再也不行了。然后我想起官方文档里有推荐安装watchman，说可以解决文件监控到某些bug。第一次装到时候执行./autogen.sh 不成功，然后觉得这个东西是可选项，所以就没装。后来我猜可能就是这个导致的问题。

按照常规方法安装watchman之前需要

linux安装watchman先要安装依赖

sudo apt-get install autoconf automake python-dev
然后如官方的做法依次执行

git clone https://github.com/facebook/watchman.git
cd watchman
git checkout v4.7.0 # 这是facebook官方文档说的最新稳定版本
./autogen.sh
./configure
make
sudo make install
刚安装完watchman，运行react-native start会报这样到错误

ERROR A non-recoverable condition has triggered. Watchman needs your help!
The triggering condition was at timestamp=1481104643: inotify-add-watch(/home/boolean/Workspace/react-native-TIMMangaerDemo_android/android/reactnativelibrary/build/generated/source/r/debug) -> The user limit on the total number of inotify watches was reached; increase the fs.inotify.max_user_watches sysctl
All requests will continue to fail with this message until you resolve
the underlying problem. You will find more information on fixing this at
https://facebook.github.io/watchman/docs/troubleshooting.html#poison-inotify-add-watch
去facebook的网站看了相关说明以后知道是inotify-add-watch的问题，但是不知道如何去增加这个限制。后来又去watchman的安装说明网站。看到如下说明

You obviously need to ensure that max_user_instances and max_user_watches are set so that the system is capable of keeping track of your files.
/proc/sys/fs/inotify/max_user_watches impacts how many dirs you can watch across all watched roots.
那么怎么调整max_user-watches的值呢。查找以后，发现这是内核的东西，不好轻易改变，需要用下面到方法：


vim /etc/sysctl.conf
在文件里面添加
fs.inotify.max_user_watches=16384

(这个是系统默认值到两倍，够用了)，
:wq保存
然后运行/sbin/sysctl -p使其立即生效
使用
sysclt -a
可以看到fs.inotify.max_user_watches = 16384
或者直接查看/proc/sys/fs/inotify/max_user_watches这个文件（切勿直接修改这个文件，因为即使你修改了当时生效，等你重启电脑，这个值又会恢复默认）。

好了，再运行react-native start就OK了

关于用真机调试

和你的浏览器端不在同一wifi环境，可以直接调试，linux需要手动启动react packager：

react-native start
这个命令你可以在工程编译运行之后执行。
另外，如果你中途有断开usb连接，那么需要执行

adb reverse tcp:8081 tcp:8081
和你的浏览器端在同一wifi环境下
此时需要你查找本机ip地址和端口，然后摇晃手机，在device settings里设置ip地址和端口。

另外，有时候你会遇到这样的问题：

{你的app 名字} has not been registered. This is other due to a require() error during initialization...
这可能是你的packager是另外一个工程的，而且占用了8081的端口。解决办法就是stop目前的packager，然后在工程目录下重启packager：

react-native start
