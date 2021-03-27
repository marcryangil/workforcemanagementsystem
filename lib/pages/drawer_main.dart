import 'package:flutter/material.dart';

class DrawerMain extends StatelessWidget {

  final color_purple = Color(0xFF621299);

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: Drawer(
        child: Container(
          color: color_purple,
          child: ListView(
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
                  Navigator.pop(context);
                },
              ),
              ListTile(
                title: Text('Item 2'),
                onTap: () {
                  Navigator.pop(context);
                },
              ),
            ],
          ),
        ),
      ),
    );
  }
}
