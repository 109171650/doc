npm install react-native-video --save
react-native link

npm install react-navigation --save
react-native link

1. 安装模块

  首先，在初始化了RN项目之后，通过npm在项目中添加react-native-video：

npm install react-native-video –save
  RN不像原生Andriod或者IOS，RN在开发的时候，是可以动态刷新查看效果，类似于混合App的开发，但是又不同于混合App，一些原生开发的组件，是无法做到直接动态刷新的，想要在引入原生组件之后，还能看到效果，一个办法就是重新编译安装一遍，但是这种方法明显太浪费时间，另外一个方法就是使用rnpm。

  rnpm也是一个npm模块，可以使用npm添加到项目中：

npm install rnpm –save
  所以在安装完react-native-video以及rnpm之后，需要继续在控制台中输入:

rnpm link react-native-video
或者直接 rnpm link
  除了react-native-video之外，以下组件都是原生开发，wrapper了一层js，因此在使用的时候，都需要link .a到project中：

react-native-vector-icons//字体图标

react-native-image-picker//读入照片

react-native-camera//相机

react-native-linear-gradient//颜色渐变

react-native-search-bar//search bar

react-native-tableview//原生的tableview，可以在list右侧显示索引
react-native-video  //Video组件

2.引入原生模块

  因为react-native-video是原生组件，所以安装完react-native-video之后，还需要修改Java代码。

  详细步骤如下：

2.1 IOS平台

  如果是IOS平台，那么就比较简单了，找到AppDelegate.m文件：

  1. 首先导入包，在此文件顶部添加如下代码:
  `#import <AVFoundation/AVFoundation.h>`

  2. 然后，修改下面的代码：
(BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary*)launchOptions
{
  ...
  [[AVAudioSession sharedInstance] setCategory:AVAudioSessionCategoryAmbient error:nil];  // allow
  ...
}

2.1 Andriod平台

  Andriod平台稍微麻烦一点。

1. 首先，找到 android/settings.gradle 这个文件，在其中加入以下代码：
    include ':react-native-video'
    project(':react-native-video').projectDir = new File(rootProject.projectDir, '../node_modules/react-native-video/android')

2. 找到 android/app/build.gradle 这个文件，在 * dependencies *大括号的方法中添加如下代码：
    compile project(':react-native-video')
就像这样：
    dependencies {
       ...
       compile project(':react-native-video')
    }

3. 如果你的 react-native版本<0.29，那么找到MainActivity.java 这个文件，在最顶部添加：import com.brentvatne.react.ReactVideoPackage;
并且在下面的代码中添加：new ReactVideoPackage()

   如果你的 react-native版本>=0.29，那么就找到MainApplication.java这个文件，在顶部添加：import com.brentvatne.react.ReactVideoPackage;

   并且在下面的代码中添加：new ReactVideoPackage()

   就像这样：
    @Override
    protected List<ReactPackage> getPackages() {
      return Arrays.<ReactPackage>asList(
          new MainReactPackage(),
          new ReactVideoPackage()
      );
    }

3. 使用方法

  借鉴npm官网上的例子：

<Video source={{uri: "background"}} // 视频的URL地址，或者本地地址，都可以.
       rate={1.0}                   // 控制暂停/播放，0 代表暂停paused, 1代表播放normal.
       volume={1.0}                 // 声音的放大倍数，0 代表没有声音，就是静音muted, 1 代表正常音量 normal，更大的数字表示放大的倍数
       muted={false}                // true代表静音，默认为false.
       paused={false}               // true代表暂停，默认为false
       resizeMode="cover"           // 视频的自适应伸缩铺放行为，
       repeat={true}                // 是否重复播放
       playInBackground={false}     // 当app转到后台运行的时候，播放是否暂停
       playWhenInactive={false}     // [iOS] Video continues to play when control or notification center are shown. 仅适用于IOS
       onLoadStart={this.loadStart} // 当视频开始加载时的回调函数
       onLoad={this.setDuration}    // 当视频加载完毕时的回调函数
       onProgress={this.setTime}    //  进度控制，每250ms调用一次，以获取视频播放的进度
       onEnd={this.onEnd}           // 当视频播放完毕后的回调函数
       onError={this.videoError}    // 当视频不能加载，或出错后的回调函数
       style={styles.backgroundVideo} />

// 样式
var styles = StyleSheet.create({
  backgroundVideo: {
    position: 'absolute',
    top: 0,
    left: 0,
    bottom: 0,
    right: 0,
  },
});
