import 'package:flutter/material.dart';

class DrawerMain extends StatelessWidget {

  final color_purple = Color(0xFF621299);
  //#ebb1ff
  final button_color_purple = Color(0xFFebb1ff);

  final arrow_down = Icon(Icons.arrow_drop_down,color: Colors.white,);

  @override
  Widget build(BuildContext context) {
    return Drawer(
      child: MaterialApp(
        theme: ThemeData(
          fontFamily: 'WorkSans',
          textTheme: TextTheme(
            bodyText1: TextStyle(fontSize: 20.0, color: Colors.white),// ListView pages
            bodyText2: TextStyle(fontSize: 18.0, color: Colors.grey[350]), // labels
            subtitle1: TextStyle(fontSize: 20.0, color: Colors.white),

          ),
        ),
        home: Drawer(
          child: Container(
            color: color_purple,
            child: ListView(
              padding: EdgeInsets.fromLTRB(15.0, 20, 15, 0),
              children: <Widget>[
                Text(
                  'Personal'
                ),
                ListTile(
                  title: Text('Profile Settings'),
                  onTap: () {Navigator.pushNamed(context, '/profileSettings');},
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
                ExpansionTile(
                  trailing: arrow_down,
                  childrenPadding: EdgeInsets.fromLTRB(16, 0, 0, 0),
                  title: Text('Supervisors'),
                  children: [
                    ListTile(
                      title: Text('Add Supervisor'),
                      onTap: () {Navigator.pushNamed(context, '/addSupervisor');},
                    ),
                    ListTile(
                      title: Text('Manage Supervisors'),
                      onTap: () {
                        Navigator.pop(context);
                      },
                    ),
                    ListTile(
                      title: Text('Teams'),
                      onTap: () {
                        Navigator.pop(context);
                      },
                    ),
                  ],
                ),
                ExpansionTile(
                  trailing: arrow_down,
                  childrenPadding: EdgeInsets.fromLTRB(16, 0, 0, 0),
                  title: Text('Employees'),
                  children: [
                    ListTile(
                      title: Text('Add Employee'),
                      onTap: () {Navigator.pushNamed(context, '/addEmployee');},
                    ),
                    ListTile(
                      title: Text('Manage Employees'),
                      onTap: () {
                        Navigator.pop(context);
                      },
                    ),
                  ],
                ),
                Text(
                    'Productivity'
                ),
                ExpansionTile(
                  trailing: arrow_down,
                  childrenPadding: EdgeInsets.fromLTRB(16, 0, 0, 0),
                  title: Text('Workforce Glance'),
                  children: [
                    ListTile(
                      title: Text('Set Productivity Level'),
                      onTap: () {
                        Navigator.pop(context);
                      },
                    ),
                    ListTile(
                      title: Text('View Productivity'),
                      onTap: () {
                        Navigator.pop(context);
                      },
                    ),
                    ListTile(
                      title: Text('Weekly Report'),
                      onTap: () {
                        Navigator.pop(context);
                      },
                    ),
                  ],
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
                SizedBox(height: 260,),
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
                  child: SizedBox(
                    height: 45,
                    child: OutlinedButton(
                      onPressed: (){
                        Navigator.pushNamed(context, '/login');
                      },
                      child: Text('Log out'),
                      style: OutlinedButton.styleFrom(
                          shape: new RoundedRectangleBorder(borderRadius: new BorderRadius.circular(10.0)),
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
