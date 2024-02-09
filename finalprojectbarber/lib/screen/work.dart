import 'package:flutter/material.dart';
import 'package:finalprojectbarber/screen/picker.dart';
import 'package:table_calendar/table_calendar.dart';

class UserWork extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('WorkPage'),
      ),
      body: Center(
        child: CalendarWidget(),
      ),
    );
  }
}

class CalendarWidget extends StatefulWidget {
  @override
  _CalendarWidgetState createState() => _CalendarWidgetState();
}

class _CalendarWidgetState extends State<CalendarWidget> {
  CalendarFormat _calendarFormat = CalendarFormat.month;
  DateTime _focusedDay = DateTime.now();
  DateTime _selectedDay = DateTime.now();

  @override
  Widget build(BuildContext context) {
    return TableCalendar(
      firstDay: DateTime.utc(2021, 1, 1),
      lastDay: DateTime.utc(2024, 12, 31),
      focusedDay: _focusedDay,
      calendarFormat: _calendarFormat,
      selectedDayPredicate: (day) {
        return isSameDay(_selectedDay, day);
      },
      onDaySelected: (selectedDay, focusedDay) {
        setState(() {
          _selectedDay = selectedDay;
          _focusedDay = focusedDay;
        });

        // แปลง DateTime เป็น timestamp ในรูปแบบวินาที
        int timestampInSeconds = (_selectedDay.millisecondsSinceEpoch ~/ 1000);

        // เปิดหน้า TimePicker และส่ง timestamp ไปด้วย
        Navigator.push(
          context,
          MaterialPageRoute(
            builder: (context) => TimePicker(timestampInSeconds),
          ),
        );
      },
      onFormatChanged: (format) {
        setState(() {
          _calendarFormat = format;
        });
      },
      calendarBuilders: CalendarBuilders(
        selectedBuilder: (context, date, events) => Container(
          margin: const EdgeInsets.all(4.0),
          alignment: Alignment.center,
          decoration: BoxDecoration(
            color: Theme.of(context).primaryColor,
            borderRadius: BorderRadius.circular(10.0),
          ),
          child: Text(
            date.day.toString(),
            style: TextStyle(color: Colors.white),
          ),
        ),
      ),
    );
  }
}
