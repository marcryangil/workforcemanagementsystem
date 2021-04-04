import 'package:workforce_management_system/api/model/profile.dart';
import 'package:workforce_management_system/api/utils/env_endpoints.dart';
import 'package:workforce_management_system/api/utils/network.dart';

class APIGateway {
  final EnvEndpoints envEndpoints = EnvEndpoints();

  Profile profile;

  Future <Profile> asyncGet() async {
    try {
      Network network = Network(envEndpoints.getEndpoints('/api/myinfo/1'));
      dynamic body = await network.getData();

      profile = Profile.fromJson(body);
    } catch (e) {
      print (e);
    }
    return profile;

  }
}