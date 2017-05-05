
创建swap分区是为了弥补物理内存的不足，也就是虚拟内存的概念，把硬盘的一部分划分作为虚拟内存，但这个空间不是越大越好，硬盘的速度远低于内存，设置不当反而拖慢系统的速度。

阿里云的主机默认没有swap分区，可以使用free命令查看：
这是在阿里云CentOS 7系统上创建好swap分区后的截图。下面记录在阿里云CentOS 7上创建swap分区的步骤：

①使用dd命令创建一个swap分区

    dd if=/dev/zero of=/home/swap bs=1024 count=1048576

count的值是：size（多少M）* 1024，我这里设置的1G虚拟内存，也就是count=1024000.

②格式化swap分区

      mkswap /home/swap

③把格式化后的文件分区设置为swap分区

      swapon /home/swap

（关闭SWAP分区命令为：[root@localhost Desktop]#swapoff /home/swap）

此时，swap分区已经创建好了，使用free命令查看，可见多了一个挂载分区。

④swap分区自动挂载

      vi /etc/fstab

在文件末尾加上

      /home/swap swap swap default 0 0
