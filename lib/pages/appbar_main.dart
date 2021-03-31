import 'package:flutter/material.dart';


import 'package:workforce_management_system/pages/drawer_main.dart';

class AppBarAndDrawer extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);

  int counter = 0;
  GlobalKey<ScaffoldState> _drawerKey = GlobalKey();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        body: Scaffold(
          drawer: DrawerMain(),
          key: _drawerKey,
        ),
        backgroundColor: color_white,
        appBar: AppBar(
        title: Text('Pending: Date'),
        leading: Builder(
          builder: (BuildContext context){
            return IconButton(
              icon: const Icon(Icons.sort_rounded,size: 40,),
              onPressed: () {
                if (_drawerKey.currentState.isDrawerOpen) {
                  _drawerKey.currentState.openEndDrawer();
                } else {
                  _drawerKey.currentState.openDrawer();
                }
              },
              tooltip: MaterialLocalizations.of(context).openAppDrawerTooltip,
            );
          },
        ),
        backgroundColor: color_purple,
      ),
    );
  }
}


