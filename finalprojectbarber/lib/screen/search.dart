import 'dart:io';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:image_picker/image_picker.dart';

class ImageUploadPage extends StatefulWidget {
  @override
  _ImageUploadPageState createState() => _ImageUploadPageState();
}

class _ImageUploadPageState extends State<ImageUploadPage> {
  File? _imageFile;

  Future<void> _uploadImage() async {
    if (_imageFile == null) {
      // กรณีไม่มีรูปภาพที่เลือก
      print('No image selected');
      return;
    }

    final url = Uri.parse('http://127.0.0.1/user/upload.php');
    // แทนที่ URL ของคุณที่เก็บไฟล์ PHP
    var request = http.MultipartRequest('POST', url)
      ..files.add(http.MultipartFile(
        'image',
        _imageFile!.readAsBytes().asStream(),
        _imageFile!.lengthSync(),
        filename: 'uploaded_image.jpg',
      ));

    try {
      var response = await request.send();
      if (response.statusCode == 200) {
        print('Image uploaded successfully');
      } else {
        print('Failed to upload image. Status code: ${response.statusCode}');
      }
    } catch (error) {
      print('Error uploading image: $error');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Image Upload'),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            _imageFile != null
                ? kIsWeb
                    ? Image.network(
                        'URL ของรูปภาพ',
                        height: 150,
                      )
                    : Image.file(
                        _imageFile!,
                        height: 150,
                      )
                : Container(
                    height: 150,
                    color: Colors.grey[200],
                    child: Icon(Icons.image, size: 50),
                  ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: () async {
                final picker = ImagePicker();
                final pickedFile =
                    await picker.pickImage(source: ImageSource.gallery);

                if (pickedFile != null) {
                  setState(() {
                    _imageFile = File(pickedFile.path);
                  });
                }
              },
              child: Text('เพิ่มรูป'),
            ),
          ],
        ),
      ),
    );
  }
}
