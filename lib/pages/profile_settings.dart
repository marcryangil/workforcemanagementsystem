import 'package:flutter/material.dart';


import 'package:workforce_management_system/pages/drawer_main.dart';

class Profile_Settings extends StatelessWidget {

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
        body: Padding(
          padding: EdgeInsets.fromLTRB(20.0, 15.0, 20.0, 0.0),
          child: ListView(
            children: [
              Text(
                'Profile Settings',
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
              SizedBox(height: 15.0,),
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
                  'Password',
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
                    obscureText: true,
                    decoration: InputDecoration(
                      fillColor: Colors.white,
                      filled: true,
                      border: OutlineInputBorder(
                        borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                      ),
                      labelText: 'Password',
                      contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0,),
              Container(
                padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                child: Text(
                  'New Password',
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
                    obscureText: true,
                    decoration: InputDecoration(
                      fillColor: Colors.white,
                      filled: true,
                      border: OutlineInputBorder(
                        borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                      ),
                      labelText: 'New Password',
                      contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 20.0,),
              Container(
                padding: EdgeInsets.fromLTRB(60.0, 0, 0, 12),
                child: Text(
                  'Re-enter Password',
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
                    obscureText: true,
                    decoration: InputDecoration(
                      fillColor: Colors.white,
                      filled: true,
                      border: OutlineInputBorder(
                        borderRadius: const BorderRadius.all(const Radius.circular(30.0)),
                      ),
                      labelText: 'Re-enter Password',
                      contentPadding: EdgeInsets.fromLTRB(30.0, 16, 30, 16),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 25.0,),
              Center(
                child: OutlinedButton(
                  onPressed: (){
                    Navigator.pushNamed(context, '/dashboard');
                  },
                  child: Text('Save Changes'),
                  style: OutlinedButton.styleFrom(
                      padding: EdgeInsets.fromLTRB(100.0, 12.0, 100.0, 12.0),
                      backgroundColor: color_purple,
                      primary: Colors.white,
                      textStyle: TextStyle(
                          fontSize: 20.0,
                          fontFamily: 'WorkSans'
                      )
                  ),
                ),
              ),
              Center(child: Container(
                padding: EdgeInsets.fromLTRB(0, 0, 0, 0),
                child: Image.asset(
                  'assets/frontdesk.png',
                ),
              ),
              ),
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


