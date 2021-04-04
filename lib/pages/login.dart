//import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:workforce_management_system/api/model/profile.dart';
import 'package:workforce_management_system/api/service/api_gateway.dart';
import 'package:workforce_management_system/api/utils/env_endpoints.dart';

class Login extends StatefulWidget {

  ///test
  Login({Key key, this.title}) : super(key: key);
  final String title;
  ///
  @override
  _LoginState createState() => _LoginState();
}

class _LoginState extends State<Login> {
  ///test
  final EnvEndpoints envEndpoints = EnvEndpoints();
  final APIGateway apiGateway = APIGateway();
  Future <Profile> _myProfile;

  void _session() async {
    setState(() {
      _myProfile = apiGateway.asyncGet();
    });
  }

  void initState() {
    super.initState();
    _session();
  }
  ///

  final color_purple = Color(0xFF621299);
  final color_white = Color(0xFFF5F5F5);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: color_white,
      body: Padding(
        padding: EdgeInsets.fromLTRB(60.0, 210.0, 60.0, 0.0),
        child: ListView(
          children: [
            Center(child: Image.asset(
              'assets/frontdesk.png',
            )),
            Center(
              child: Text(
                'Make every work hour count.',
                style: TextStyle(
                  color: color_purple,
                  fontFamily: 'WorkSans',
                  letterSpacing: 2.0,
                  fontSize: 20.0,
                ),
              ),
            ),
            SizedBox(height: 60.0,),
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
            SizedBox(height: 40.0,),
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
            SizedBox(height: 40.0,),
            Center(
              child: SizedBox(
                height: 45,
                child: OutlinedButton(
                  onPressed: (){
                    Navigator.pushNamed(context, '/dashboard');
                  },
                  child: Text('Login'),
                  style: OutlinedButton.styleFrom(
                      shape: new RoundedRectangleBorder(borderRadius: new BorderRadius.circular(10.0)),
                      padding: EdgeInsets.fromLTRB(140.0, 12.0, 140.0, 12.0),
                      backgroundColor: color_purple,
                      primary: Colors.white,
                      textStyle: TextStyle(
                        fontSize: 20.0,
                        fontFamily: 'WorkSans'
                      )
                  ),
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
