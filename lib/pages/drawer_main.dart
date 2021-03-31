import 'package:flutter/material.dart';

class DrawerMain extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  //#ebb1ff
  final button_color_purple = Color(0xFFebb1ff);

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: MaterialApp(
        theme: ThemeData(
          fontFamily: 'WorkSans',
          textTheme: TextTheme(
            bodyText1: TextStyle(fontSize: 20.0, color: Colors.white),// ListView pages
            bodyText2: TextStyle(fontSize: 18.0, color: Colors.grey[350]), // labels
          ),
        ),
        home: Drawer(
          child: Container(
            color: color_purple,
            child: ListView(
              padding: EdgeInsets.fromLTRB(15.0, 20, 15.0, 0),
              children: <Widget>[
                Text(
                  'Personal'
                ),
                ListTile(
                  title: Text('Profile Settings'),
                  onTap: () {
                    Navigator.pushNamed(context, '/addSupervisor');
                    //Navigator.pop(context);
                  },
                ),
                Text(
                    'Core'
                ),
                ListTile(
                  title: Text('Dashboard'),
                  onTap: () {
                    Navigator.pop(context);
                  },
                ),
                Text(
                    'Management'
                ),
                ListTile(
                  title: Text('Supervisors'),
                  onTap: () {
                    Navigator.pop(context);
                  },
                ),
                ListTile(
                  title: Text('Employees'),
                  onTap: () {
                    Navigator.pop(context);
                  },
                ),
                Text(
                    'Productivity'
                ),
                ListTile(
                  title: Text('Workforce Glance'),
                  onTap: () {
                    Navigator.pop(context);
                  },
                ),
                ListTile(
                  title: Text('Charts and Measures'),
                  onTap: () {
                    Navigator.pop(context);
                  },
                ),
                Text(
                    'Record'
                ),
                ListTile(
                  title: Text('History Log'),
                  onTap: () {
                    Navigator.pop(context);
                  },
                ),
                SizedBox(height: 210,),
                Text(
                    'Logged in as:'
                ),
                SizedBox(height: 10,),
                Text(
                    'Admin',
                  style: TextStyle(
                      fontSize: 20.0,
                      color: Colors.white,
                  ),
                ),
                SizedBox(height: 10,),
                Center(
                  child: OutlinedButton(
                    onPressed: (){
                      Navigator.pushNamed(context, '/login');
                    },
                    child: Text('Log out'),
                    style: OutlinedButton.styleFrom(
                        padding: EdgeInsets.fromLTRB(100, 12.0, 100, 12.0),
                        backgroundColor: button_color_purple,
                        primary: color_purple,
                        textStyle: TextStyle(
                            fontSize: 20.0,
                            fontFamily: 'WorkSans',
                            fontWeight: FontWeight.bold,
                        )
                    ),
                  ),
                )
              ],
            ),
          ),
        ),
      ),
    );
  }
}
