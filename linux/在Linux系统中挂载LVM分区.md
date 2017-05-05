LVM分区一般都是存在于U盘当中，Linux系统通过U盘来访问这些分区。如果想让Linux直接访问这些分区，可以在Linux系统中直接挂载这些分区。本文就来介绍一下，在Linux系统中挂载这些分区的方法。
方法/步骤

LVM分区一般都是存在于U盘当中，Linux系统通过U盘来访问这些分区。如果想让Linux直接访问这些分区，可以在Linux系统中直接挂载这些分区。本文就来介绍一下，在Linux系统中挂载这些分区的方法。

LVM是逻辑卷管理工具，它允许你使用逻辑卷和卷组的概念来管理磁盘空间。使用LVM相比传统分区最大的好处是弹性地为用户和程序分配空间而不用考虑每个物理磁盘的大小。

在LVM中，那些创建了逻辑分区的物理存储是传统的分区（比如：/dev/sda2，/dev/sdb1）。这些分区必须被初始化为“物理卷 PV”并加上卷标（如，“Linux LVM”）来使它们可以在LVM中使用。一旦分区被标记被LVM分区，你不能直接用mount命令挂载。

如果你尝试挂载一个LVM分区（比如/dev/sdb2）， 你会得到下面的错误。

    　　$ mount /dev/sdb2 /mnt mount： unknown filesystem type ‘LVM2_member’
在Linux系统中挂载LVM分区的步骤

要正确地挂载LVM分区，你必须挂载分区中创建的“逻辑卷”。下面就是如何做的。

首先，用下面的命令检查可用的卷组：

    　　$ sudo pvs PV VG Fmt Attr PSize PFree /dev/sdb2 vg_ezsetupsystem40a8f02fadd0 lvm2 a-- 237.60g 0
在Linux系统中挂载LVM分区的步骤

　　物理卷的名字和卷组的名字分别在PV和VG列的下面。本例中，只有一个创建在dev/sdb2下的组“vg_ezsetupsystem40a8f02fadd0”。

　　接下来检查卷组中存在的逻辑卷，使用lvdisplay命令：

    　　$ sudo lvdisplay 《volume-group-name》

    　　使用lvdisplay显示了可用卷的信息（如：设备名、卷名、卷大小等等）。

    　　$ sudo lvdisplay /dev/vg_ezsetupsystem40a8f02fadd0

    　　--- Logical volume ---

    　　LV Path /dev/vg_ezsetupsystem40a8f02fadd0/lv_root

    　　LV Name lv_root

    　　VG Name vg_ezsetupsystem40a8f02fadd0

    　　LV UUID imygta-P2rv-2SMU-5ugQ-g99D-A0Cb-m31eet

    　　LV Write Access read/write

    　　LV Creation host， time livecd.centos， 2015-03-16 18:38:18 -0400

    　　LV Status available

    　　# open 0

    　　LV Size 50.00 GiB

    　　Current LE 12800

    　　Segments 1

    　　Allocation inherit

    　　Read ahead sectors auto

    　　- currently set to 256

    　　Block device 252:0
在Linux系统中挂载LVM分区的步骤

　　上图可以看到两个逻辑卷的名字：lv_root和lv_home

　　如果你想要挂载一个特定的逻辑卷，使用如下的“LV Path”的设备名（如：/dev/vg_ezsetupsystem40a8f02fadd0/lv_home）。

    　　$ sudo mount /dev/vg_ezsetupsystem40a8f02fadd0/lv_home /mnt

    　　你可以用mount命令不带任何参数检查挂载状态，这会显示所有已挂载的文件系统。

    　　$ mount
在Linux系统中挂载LVM分区的步骤

　　如果你想在每次启动时自动挂载逻辑卷，在/etc/fstab中添加下面的行，你可以指定卷的文件系统类型（如 ext4），它可以从mount命令的输出中找。

    　　/dev/vg_ezsetupsystem40a8f02fadd0/lv_home /mnt ext4 defaults 0 0

　　现在逻辑卷会在每次启动时挂载到/mnt。

　　以上就是在Linux系统中挂载LVM分区的方法了，挂载好LVM分区后就可以用Linux系统对这些分区进行管理。

    mount /dev/centos/home /root/win
