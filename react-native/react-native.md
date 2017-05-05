    http://facebook.github.io/react-native/
    http://reactnative.cn/
    npm install react-native-tab-navigator --save
    https://github.com/exponent/react-native-tab-navigator

报错处理
could not get batchedbridge, make sure your bundle is packaged correctly
1、需要先启动npm
    npm start
否则需手工生成目录
    mkdir android/app/src/main/assets
    react-native bundle --platform android --dev false --entry-file index.android.js --bundle-output android/app/src/main/assets/index.android.bundle --assets-dest android/app/src/main/res/

    cd android
    sudo ./gradlew clean

Error when running watchman
echo 256 | sudo tee -a /proc/sys/fs/inotify/max_user_instances
echo 32768 | sudo tee -a /proc/sys/fs/inotify/max_queued_events
echo 65536 | sudo tee -a /proc/sys/fs/inotify/max_user_watches
watchman shutdown-server
