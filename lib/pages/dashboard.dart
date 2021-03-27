import 'package:flutter/material.dart';


import 'package:workforce_management_system/pages/drawer_main.dart';

class Dashboard extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);

  int counter = 0;
  GlobalKey<ScaffoldState> _drawerKey = GlobalKey();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Stack(
        children: [
          Scaffold(drawer: DrawerMain(),key: _drawerKey,)
        ],
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
                //Scaffold.of(context).openDrawer();
                //counter = counter + 1;

                //_drawerKey.currentState.openDrawer();
              },
              tooltip: MaterialLocalizations.of(context).openAppDrawerTooltip,
            );
          },
        ),
        backgroundColor: color_purple,
      ),
      /*drawer: Drawer(
        // Add a ListView to the drawer. This ensures the user can scroll
        // through the options in the drawer if there isn't enough vertical
        // space to fit everything.
        child: Container(
          color: color_purple,
          child: ListView(
            // Important: Remove any padding from the ListView.
            padding: EdgeInsets.zero,
            children: <Widget>[
              DrawerHeader(
                child: Text('Drawer Header'),
                decoration: BoxDecoration(
                  //color: color_purple,
                ),
              ),
              ListTile(
                title: Text('Item 1'),
                onTap: () {
                  // Update the state of the app
                  // ...
                  // Then close the drawer
                  Navigator.pop(context);
                },
              ),
              ListTile(
                title: Text('Item 2'),
                onTap: () {
                  // Update the state of the app
                  // ...
                  // Then close the drawer
                  Navigator.pop(context);
                },
              ),
            ],
          ),
        ),
      ),*/
    );
  }
}


