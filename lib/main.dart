import 'package:flutter/material.dart';
import 'package:workforce_management_system/pages/dashboard.dart';
import 'package:workforce_management_system/pages/login.dart';
import 'package:workforce_management_system/pages/portal.dart';

void main() {
  runApp(MaterialApp(
    initialRoute: '/',
    routes: {
      '/': (context) => Portal(),
      '/login': (context) => Login(),
      '/dashboard': (context) => Dashboard(),
    },
  ));
}