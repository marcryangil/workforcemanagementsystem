import 'package:flutter/material.dart';
import 'package:workforce_management_system/pages/add_employee.dart';
import 'package:workforce_management_system/pages/add_supervisor.dart';
import 'package:workforce_management_system/pages/charts_and_measures.dart';
import 'package:workforce_management_system/pages/dashboard.dart';
import 'package:workforce_management_system/pages/login.dart';
import 'package:workforce_management_system/pages/portal.dart';
import 'package:workforce_management_system/pages/profile_settings.dart';

void main() {
  final String appName = 'Workforce Management System';
  runApp(MaterialApp(
    title: appName,
    theme: ThemeData(
        fontFamily: 'WorkSans'
    ),
    initialRoute: '/',
    routes: {
      '/': (context) => Portal(),
      '/login': (context) => Login(),
      '/dashboard': (context) => Dashboard(),
      '/profileSettings': (context) => Profile_Settings(),
      '/addSupervisor': (context) => Add_Supervisor(),
      '/addEmployee': (context) => Add_Employee(),
      '/chartsAndMeasures': (context) => ChartsAndMeasures(),
    },
  ));
}