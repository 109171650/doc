
[global]
        workgroup = SAMBA
        security = user
        map to guest = Bad User

        passdb backend = tdbsam

        printing = cups
        printcap name = cups
        load printers = yes
        cups options = raw

[homes]
        comment = Home Directories
        valid users = %S, %D%w%S
        browseable = No
        read only = No
        inherit acls = Yes

[printers]
        comment = All Printers
        path = /var/tmp
        printable = Yes
        create mask = 0600
        browseable = No

[print$]
        comment = Printer Drivers
        path = /var/lib/samba/drivers
        write list = root
        create mask = 0664
        directory mask = 0775
[data]
        comment=shared files
        path=/data
        public=yes
        writeable=yes
        create mask = 0775
        directory mask = 0775
