
    VirtualBox 5.0.8
    OS X 10.11

VboxManage 命令

    VBoxManage modifyvm "OSXElCapitan"  --cpuidset 00000001 000306a9 04100800 7fbae3ff bfebfbff
    VBoxManage setextradata "OSXElCapitan"  "VBoxInternal/Devices/efi/0/Config/DmiSystemProduct" "MacBookPro11,3"
    VBoxManage setextradata "OSXElCapitan"  "VBoxInternal/Devices/efi/0/Config/DmiSystemVersion" "1.0"
    VBoxManage setextradata "OSXElCapitan"  "VBoxInternal/Devices/efi/0/Config/DmiBoardProduct" "Iloveapple"
    VBoxManage setextradata "OSXElCapitan"  "VBoxInternal/Devices/smc/0/Config/DeviceKey" "ourhardworkbythesewordsguardedpleasedontsteal(c)AppleComputerInc"
    VBoxManage setextradata "OSXElCapitan"  "VBoxInternal/Devices/smc/0/Config/GetKeyFromRealSMC" 1

如需要更改 虚拟机分辨率 1440×900 输入命令如下：

    VBoxManage setextradata "OSXElCapitan" "VBoxInternal2/EfiGopMode" 5
其中数字表示如下, 虚拟机默认分辨率值是 2 – 1024×768

    0 – 640×480
    1 – 800×600
    2 – 1024×768
    3 – 1280×1024
    4 – 1440×900
    5  – 1920×1200

启动虚拟机
关闭 VirtualBOX
重新正常启动 VirtualBOX, 及启动 OSXYosemite 虚拟机文件
进行一些系统设置

安装 xcode 7
下载xcode

参考链接:

http://bbs.feng.com/read-htm-tid-9908410.html

http://bbs.feng.com/read-htm-tid-8474315.html
