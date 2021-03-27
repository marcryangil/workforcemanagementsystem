//import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class Portal extends StatelessWidget {

  final color_purple = Color(0xFF621299);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: color_purple,
      body: Padding(
        padding: EdgeInsets.fromLTRB(60.0, 210.0, 60.0, 0.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Center(child: Image.asset(
              'assets/time-management.png',
              height: 200,
              width: 200,
            )),
            //SizedBox(height: 5.0,),
            Center(
              child: Text(
                'WORKFORCE',
                style: TextStyle(
                  color: Colors.white,
                  fontFamily: 'WorkSans',
                  letterSpacing: 2.0,
                  fontSize: 40.0,
                ),
              ),
            ),
            Center(
              child: Text(
                'MANAGEMENT',
                style: TextStyle(
                  color: Colors.white,
                  fontFamily: 'WorkSans',
                  letterSpacing: 2.0,
                  fontSize: 40.0,
                ),
              ),
            ),
            Center(
              child: Text(
                'SYSTEM',
                style: TextStyle(
                  color: Colors.white,
                  fontFamily: 'WorkSans',
                  letterSpacing: 2.0,
                  fontSize: 40.0,
                ),
              ),
            ),
            SizedBox(height: 10.0,),
            Center(
              child: Text(
                'BY CLOVERBYTE',
                style: TextStyle(
                  color: Colors.white,
                  fontFamily: 'WorkSans',
                  letterSpacing: 2.0,
                  fontSize: 13.0,
                ),
              ),
            ),
            SizedBox(height: 40.0,),
            Center(
              child: OutlinedButton(
                onPressed: (){
                  Navigator.pushNamed(context, '/login');
                },
                child: Text('Portal'),
                style: OutlinedButton.styleFrom(
                    padding: EdgeInsets.fromLTRB(120.0, 10.0, 120.0, 10.0),
                    backgroundColor: Colors.white,
                    primary: color_purple,
                    textStyle: TextStyle(
                      fontSize: 20.0,
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
