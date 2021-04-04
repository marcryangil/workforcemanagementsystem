import 'package:flutter/material.dart';
//import 'package:flutter/cupertino.dart';

class Profile {
  final int id;
  final String firstname;
  final String lastname;

  Profile({
    @required this.id,
    @required this.firstname,
    @required this.lastname,
  });

  factory Profile.fromJson(Map<String, dynamic> json){
    return Profile(
      id: json['data']['id'] as int,
      firstname: json['data']['firstname'] as String,
      lastname: json['data']['lastname'] as String,
    );
  }
}