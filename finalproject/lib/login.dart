import 'dart:convert';
import 'package:finalproject/homepage.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:finalproject/register.dart';
import 'package:provider/provider.dart';
import 'user_provider.dart';

class LoginPage extends StatefulWidget {
  const LoginPage({Key? key}) : super(key: key);

  @override
  State<LoginPage> createState() => _LoginPageState();
}

class _LoginPageState extends State<LoginPage> {
  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();

  // ฟังก์ชันสำหรับส่งคำขอล็อกอินไปยัง PHP API
 Future<void> loginUser(BuildContext context) async {
  final url = 'http://127.0.0.1/test/costomer/login.php';

  try {
    print('Sent data: ${{
      'email': emailController.text,
      'password': passwordController.text,
    }}');

    final response = await http.post(
      Uri.parse(url),
      body: {
        'email': emailController.text,
        'password': passwordController.text,
      },
    );

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final userProvider = Provider.of<UserProvider>(context, listen: false);
      if (data['result'] == 1) {
        final Map<String, dynamic> cusData = data['data'];
        String id = cusData['cus_id'].toString() ;

        userProvider.setCusId(id);
       
        Navigator.pushReplacement(
          context,
          MaterialPageRoute(
            builder: (context) => const HomePage(),
          ),
        );
      } else {
        showErrorDialog('อีเมลหรือรหัสผ่านไม่ถูกต้อง');
      }
    } else {
      showErrorDialog('เชื่อมต่อกับเซิร์ฟเวอร์ล้มเหลว');
    }
  } catch (error) {
    showErrorDialog('เกิดข้อผิดพลาด: $error');
  }
}

  // ฟังก์ชันสำหรับแสดงไดอะล็อกข้อผิดพลาด
  void showErrorDialog(String message) {
    showDialog(
      context: context,
      builder: (BuildContext context) {
        return AlertDialog(
          title: Text('ข้อผิดพลาด'),
          content: Text(message),
          actions: [
            TextButton(
              onPressed: () => Navigator.pop(context),
              child: Text('ตกลง'),
            ),
          ],
        );
      },
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Center(
          child: Column(
            children: [
              Image.asset(
                'assets/barber.png',
                width: 250,
                height: 250,
              ),
              SizedBox(height: 10),
              Text(
                'welcome back, you been missed',
                style: TextStyle(
                  fontSize: 20,
                ),
              ),
              SizedBox(height: 20),

              // ช่องกรอก Email
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 25.0),
                child: Container(
                  decoration: BoxDecoration(
                    color: Colors.white,
                    border: Border.all(color: Colors.grey),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.only(left: 20.0),
                    child: TextField(
                      controller: emailController,
                      decoration: InputDecoration(
                        border: InputBorder.none,
                        hintText: 'Email',
                      ),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // ช่องกรอก Password
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 25.0),
                child: Container(
                  decoration: BoxDecoration(
                    color: Colors.white,
                    border: Border.all(color: Colors.grey),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: Padding(
                    padding: const EdgeInsets.only(left: 20.0),
                    child: TextField(
                      controller: passwordController,
                      obscureText: true,
                      decoration: InputDecoration(
                        border: InputBorder.none,
                        hintText: 'Password',
                      ),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // ปุ่ม Sign-In
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 75.25),
                child: ElevatedButton(
                  onPressed: () => loginUser(context),
                  style: ElevatedButton.styleFrom(
                    padding: EdgeInsets.all(20),
                    primary: Colors.blue,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(15),
                    ),
                  ),
                  child: Center(
                    child: Text(
                      'Sign - in',
                      style: TextStyle(
                        color: Colors.white,
                        fontWeight: FontWeight.bold,
                        fontSize: 18,
                      ),
                    ),
                  ),
                ),
              ),
              SizedBox(height: 10),

              // ลงทะเบียน
              Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Text(
                    'Not a member?',
                    style: TextStyle(fontWeight: FontWeight.bold),
                  ),
                  GestureDetector(
                    onTap: () {
                      Navigator.push(context,
                          MaterialPageRoute(builder: (context) {
                        return RegisterPage();
                      }));
                    },
                    child: Text(
                      ' Register now',
                      style: TextStyle(
                        color: Colors.blue,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
