import 'package:expansion_tile_card/expansion_tile_card.dart';
import 'package:flutter/material.dart';
import 'package:workforce_management_system/charts/donut_prod_meter.dart';
import 'package:workforce_management_system/charts/line_current_week_stat.dart';
import 'package:workforce_management_system/charts/short_tick_recent_week_stat.dart';


import 'package:workforce_management_system/pages/drawer_main.dart';

class Dashboard extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);
  final color_green = Color(0xFF5FFF0F);
  final color_red = Color(0xFFea521f);

  final color_btn_teams = Color(0xFF2ebee6);
  final color_btn_prod_level = Color(0xFFfff700);
  final color_btn_prod = Color(0xFF5fff0f);
  final color_btn_weekly_report = Color(0xFFea521f);

  final arrow_down = Icon(Icons.arrow_drop_down,color: Colors.white,);

  double box_height = 160;
  double box_width = 220;
  //ea521f
  //ffe0e0
  final color_light_blue = Color(0xFFd1f2ff);

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
                  'Dashboard',
                  style: TextStyle(
                    color: color_purple,
                    fontFamily: 'WorkSans',
                    letterSpacing: 1.0,
                    fontSize: 34.0,
                  ),
                ),
                Divider(
                  thickness: 2.0,
                  color: Colors.grey,
                ),
                Center(
                  child: Text(
                    'This Week\'s Productivity Meter',
                    style: TextStyle(
                      color: color_purple,
                      fontFamily: 'WorkSans',
                      letterSpacing: 0,
                      fontSize: 25.0,
                    ),
                  ),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Container(
                      height: 200,
                      width: 200,
                      //color: Colors.black,
                      child: Column(
                        children: [
                          SizedBox(height: 50,),
                          Row(
                            //mainAxisAlignment: MainAxisAlignment.start,
                            children: [
                              SizedBox(width: 15,),
                              Container(
                                height: 10,
                                width: 30,
                                color: color_green,
                              ),
                              SizedBox(width: 5,),
                              Text(
                                'Productivity Reached',
                                style: TextStyle(
                                  color: color_purple,
                                  fontFamily: 'WorkSans',
                                  letterSpacing: 0,
                                  fontSize: 12.0,
                                ),
                              ),
                            ],
                          ),
                          Row(
                            children: [
                              SizedBox(width: 15,),
                              Container(
                                height: 10,
                                width: 30,
                                color: color_red,
                              ),
                              SizedBox(width: 5,),
                              Text(
                                'Productivity Lost',
                                style: TextStyle(
                                  color: color_purple,
                                  fontFamily: 'WorkSans',
                                  letterSpacing: 0,
                                  fontSize: 12.0,
                                ),
                              ),
                            ],
                          ),
                          SizedBox(height: 15,),
                          Text(
                            '100 %',
                            style: TextStyle(
                              color: color_purple,
                              fontFamily: 'WorkSans',
                              letterSpacing: 1.0,
                              fontSize: 40.0,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ],
                      ),
                    ),
                    SizedBox(
                      width: 200,
                      height: 200,
                      child: DonutPieChart.withSampleData(),
                    ),
                  ],
                ),
                Divider(
                  height: 16,
                  thickness: 2.0,
                  color: Colors.grey,
                ),
                Column(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: [
                        SizedBox(
                          height: box_height,
                          width: box_width,
                          child: ElevatedButton(
                            onPressed: (){
                              //
                            },
                            child: Text('TEAMS'),
                            style: OutlinedButton.styleFrom(
                                //padding: EdgeInsets.fromLTRB(100.0, 12.0, 100.0, 12.0),
                                backgroundColor: color_btn_teams,
                                primary: Colors.grey[800],
                                textStyle: TextStyle(
                                    fontSize: 20.0,
                                    fontFamily: 'WorkSans'
                                )
                            ),
                          ),
                        ),
                        SizedBox(
                          height: box_height,
                          width: box_width,
                          child: ElevatedButton(
                            onPressed: (){
                              //
                            },
                            child: Text('PRODUCTIVITY LEVEL',textAlign: TextAlign.center,),
                            style: OutlinedButton.styleFrom(
                                //padding: EdgeInsets.fromLTRB(100.0, 12.0, 100.0, 12.0),
                                backgroundColor: color_btn_prod_level,
                                primary: Colors.grey[800],
                                textStyle: TextStyle(
                                    fontSize: 20.0,
                                    fontFamily: 'WorkSans'
                                )
                            ),
                          ),
                        ),
                      ],
                    ),
                    SizedBox(height: 10,),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceAround,
                      children: [
                        SizedBox(
                          height: box_height,
                          width: box_width,
                          child: ElevatedButton(
                            onPressed: (){
                              //
                            },
                            child: Text('PRODUCTIVITY'),
                            style: OutlinedButton.styleFrom(
                              //padding: EdgeInsets.fromLTRB(100.0, 12.0, 100.0, 12.0),
                                backgroundColor: color_btn_prod,
                                primary: Colors.grey[800],
                                textStyle: TextStyle(
                                    fontSize: 20.0,
                                    fontFamily: 'WorkSans'
                                )
                            ),
                          ),
                        ),
                        SizedBox(
                          height: box_height,
                          width: box_width,
                          child: ElevatedButton(
                            onPressed: (){
                              //
                            },
                            child: Text('WEEKLY\nREPORTS',textAlign: TextAlign.center,),
                            style: OutlinedButton.styleFrom(
                              //padding: EdgeInsets.fromLTRB(100.0, 12.0, 100.0, 12.0),
                                backgroundColor: color_btn_weekly_report,
                                primary: Colors.grey[800],
                                textStyle: TextStyle(
                                    fontSize: 20.0,
                                    fontFamily: 'WorkSans'
                                )
                            ),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
                SizedBox(height: 15,),
                ExpansionTileCard(
                  baseColor: color_purple,
                  expandedColor: color_purple,
                  trailing: arrow_down,
                  title: Text(
                    'Current Week\'s Statistics',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 20.0,
                    ),
                  ),
                  children: [
                    SizedBox(
                      width: 440,
                      height: 200,
                      child: Container(
                        color: Colors.white,
                          child: PointsLineChart.withSampleData()
                      ),
                    ),
                    SizedBox(height: 15,),
                  ],
                ),
                SizedBox(height: 15,),
                ExpansionTileCard(
                  baseColor: color_purple,
                  expandedColor: color_purple,
                  trailing: arrow_down,
                  title: Text(
                    'Recent Week\'s Statistics',
                    textAlign: TextAlign.center,
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 20.0,
                    ),
                  ),
                  children: [
                    SizedBox(
                      width: 440,
                      height: 200,
                      child: Container(
                          color: Colors.white,
                          child: ShortTickLengthAxis.withSampleData()
                      ),
                    ),
                    SizedBox(height: 15,),
                  ],
                ),
                SizedBox(height: 15,),
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
                SizedBox(height: 15,),
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




