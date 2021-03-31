//import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Login extends StatelessWidget {

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
              child: OutlinedButton(
                onPressed: (){
                  Navigator.pushNamed(context, '/dashboard');
                },
                child: Text('Login'),
                style: OutlinedButton.styleFrom(
                    padding: EdgeInsets.fromLTRB(140.0, 12.0, 140.0, 12.0),
                    backgroundColor: color_purple,
                    primary: Colors.white,
                    textStyle: TextStyle(
                      fontSize: 20.0,
                      fontFamily: 'WorkSans'
                    )
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
