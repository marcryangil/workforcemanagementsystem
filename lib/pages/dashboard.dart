import 'package:flutter/material.dart';
import 'package:workforce_management_system/pages/appbar_main.dart';


class Dashboard extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);

  //final GlobalKey<ScaffoldState> _drawerKey = GlobalKey();

  @override
  Widget build(BuildContext context) {
    return Container(
      child: AppBarAndDrawer(),
    );
  }
}


