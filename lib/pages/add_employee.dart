import 'package:flutter/material.dart';


import 'package:workforce_management_system/pages/drawer_main.dart';

class Add_Employee extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);
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
                  'Add Employee',
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
                SizedBox(height: 50.0,),
                SizedBox( ////////////////////////BOX
                  width: 600,
                  height: 600,
                  child: Container(
                    padding: EdgeInsets.fromLTRB(0, 40, 0, 0),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(12),
                      color: color_light_blue,
                    ),
                    //color: Colors.black,
                    child: ListView(
                      children: [
                        Container(
                          padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                          child: Text(
                            'ID Number',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.grey[600],
                              fontFamily: 'WorkSans',
                              letterSpacing: 1.0,
                              fontSize: 20.0,
                            ),
                          ),
                        ),
                        Center(
                          child: Container(
                            width: 330,
                            child: TextField(
                              style: TextStyle(
                                  fontFamily: 'WorkSans',
                                  fontSize: 20.0
                              ),
                              decoration: InputDecoration(
                                  fillColor: Colors.white,
                                  filled: true,
                                  border: OutlineInputBorder(
                                    borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                                  ),
                                  labelText: 'ID Number',
                                  contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16)
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 20.0,),
                        Container(
                          padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                          child: Text(
                            'First Name',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.grey[600],
                              fontFamily: 'WorkSans',
                              letterSpacing: 1.0,
                              fontSize: 20.0,
                            ),
                          ),
                        ),
                        Center(
                          child: Container(
                            width: 330,
                            child: TextField(
                              style: TextStyle(
                                fontFamily: 'WorkSans',
                                fontSize: 20.0,
                              ),
                              //obscureText: true,
                              decoration: InputDecoration(
                                fillColor: Colors.white,
                                filled: true,
                                border: OutlineInputBorder(
                                  borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                                ),
                                labelText: 'First Name',
                                contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16),
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 20.0,),
                        Container(
                          padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                          child: Text(
                            'Last Name',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.grey[600],
                              fontFamily: 'WorkSans',
                              letterSpacing: 1.0,
                              fontSize: 20.0,
                            ),
                          ),
                        ),
                        Center(
                          child: Container(
                            width: 330,
                            child: TextField(
                              style: TextStyle(
                                fontFamily: 'WorkSans',
                                fontSize: 20.0,
                              ),
                              //obscureText: true,
                              decoration: InputDecoration(
                                fillColor: Colors.white,
                                filled: true,
                                border: OutlineInputBorder(
                                  borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                                ),
                                labelText: 'Last Name',
                                contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16),
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 20.0,),
                        Container(
                          padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                          child: Text(
                            'Supervisor',
                            style: TextStyle(
                              fontWeight: FontWeight.bold,
                              color: Colors.grey[600],
                              fontFamily: 'WorkSans',
                              letterSpacing: 1.0,
                              fontSize: 20.0,
                            ),
                          ),
                        ),
                        Center(
                          child: Container(
                            width: 330,
                            child: TextField(
                              style: TextStyle(
                                fontFamily: 'WorkSans',
                                fontSize: 20.0,
                              ),
                              //obscureText: true,
                              decoration: InputDecoration(
                                fillColor: Colors.white,
                                filled: true,
                                border: OutlineInputBorder(
                                  borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                                ),
                                labelText: 'ID Number',
                                contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16),
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 50.0,),
                        Center(
                          child: SizedBox(
                            height: 45,
                            child: OutlinedButton(
                              onPressed: (){
                                Navigator.pushNamed(context, '/dashboard');
                              },
                              child: Text('Add'),
                              style: OutlinedButton.styleFrom(
                                  padding: EdgeInsets.fromLTRB(150.0, 12.0, 150.0, 12.0),
                                  backgroundColor: color_purple,
                                  primary: Colors.white,
                                  textStyle: TextStyle(
                                      fontSize: 20.0,
                                      fontFamily: 'WorkSans'
                                  )
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),

                ),
                SizedBox(height: 70,),
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


