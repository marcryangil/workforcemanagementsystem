import 'package:flutter/material.dart';
import 'package:workforce_management_system/charts/domain_charts_and_measures.dart';


import 'package:workforce_management_system/pages/drawer_main.dart';

class ChartsAndMeasures extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);
  //ffe0e0
  final color_light_pink = Color(0xFFffe0e0);

  int counter = 0;
  GlobalKey<ScaffoldState> _drawerKey = GlobalKey();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Scaffold(
        drawer: DrawerMain(),
        key: _drawerKey,
        body: Padding(
          padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0, 0.0),
          child: Container(
            child: ListView(
              children: [
                Text(
                  'Charts and Measures',
                  style: TextStyle(
                    color: color_purple,
                    fontFamily: 'WorkSans',
                    letterSpacing: 1.0,
                    fontSize: 34.0,
                  ),
                ),
                Divider(
                  thickness: 2.0,
                  height: 30,
                  color: Colors.grey,
                ),
                Text(
                  'This week\'s productivity',
                  style: TextStyle(
                    color: color_purple,
                    fontFamily: 'WorkSans',
                    letterSpacing: 0,
                    fontSize: 25.0,
                  ),
                ),
                SizedBox(height: 175,),
                SizedBox(
                  width: 200,
                  height: 200,
                  child: PercentOfDomainBarChart.withSampleData(),
                ),
                SizedBox(height: 300,),
                Center(
                  //padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                  child: Text(
                    'Privacy Policy  ·  Terms and Conditions',
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      color: color_purple,
                      fontFamily: 'WorkSans',
                      letterSpacing: 2.0,
                      fontSize: 14.0,
                    ),
                  ),
                ),
                SizedBox(height: 10.0,),
                Center(
                  //padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                  child: Text(
                    'Copyright © Workforce Management System 2021',
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      color: Colors.grey[600],
                      fontFamily: 'WorkSans',
                      letterSpacing: 1.0,
                      fontSize: 8.0,
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),

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


