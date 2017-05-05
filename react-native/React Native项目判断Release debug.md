React Native中也会遇到判断项目是Release还是Debug。首先我们看下在原生应用中是怎么判断的。

在Android中:

//在Android Studio项目中

    if(BuildConfig.DEBUG){
      //debug模式
    }else{
      //release模式
    }

在iOS中：

    #ifdef DEBUG
       // debug模式
    #else
        //release 模式
    #endif

针对不同的模式，我们可以做一些特意的配置。如服务器地址等。

在React Native中也是可以进行判断的。

    if(__DEV__){
        // debug模式
    }else{
        // release模式
    }

在项目打包时也需要注意配置是否为release

可以在RN项目目录中增加两个脚本，分别针对iOS和Android打包功能。

    Android打包

    build_apk.sh
    #!/bin/bash
    rm android/app/build/outputs/app-release.apk
    cd android
    ./gradlew assembleRelease

    iOS打包

    build_ipa.sh
    #!/bin/bash

    cd ios
    rm -rf build/*
    # clean project

    xcodebuild clean -project MYAPP.xcodeproj -configuration Release -alltargets
    # make archive

    xcodebuild archive -project MYAPP.xcodeproj -scheme MYAPP -archivePath build/MYAPP.xcarchive
    # export .ipa

    xcrun xcodebuild -exportArchive -archivePath build/MYAPP.xcarchive -exportPath build -exportOptionsPlist exportPlist.plist
notice: 需要替换上述MYAPP为自己的应用名。
