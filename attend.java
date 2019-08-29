package com.example.dell.andon;

import android.Manifest;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.telephony.SmsManager;
import android.view.View;
import android.widget.Button;

import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;

import java.util.Map;

public class attend extends AppCompatActivity {

    private static final int per= 0;
    Button attend;
    public String result= new String();
    public String result_dept= new String();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.attend);

        Intent i= getIntent();
        result= i.getStringExtra("name");
        result_dept= i.getStringExtra("dept");
        System.out.println("Attended By:"+ result + result_dept);

        attend= (Button) findViewById(R.id.btn_attend);


        FirebaseDatabase database3= FirebaseDatabase.getInstance();
        DatabaseReference myRef3 = database3.getReference().child("attend");
        myRef3.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                if(dataSnapshot.getValue().equals("0")){
                    attend.setEnabled(true);
                }
                else{
                    attend.setEnabled(false);
                    // finish.setTextColor(0xFF0000); // 0xAARRGGBB
                }
            }

            @Override
            public void onCancelled(@NonNull DatabaseError databaseError) {

            }
        });

        attend.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                FirebaseDatabase database2= FirebaseDatabase.getInstance();
                DatabaseReference myRef2 = database2.getReference().child("attend");
                myRef2.setValue("1");

                FirebaseDatabase database3= FirebaseDatabase.getInstance();
                DatabaseReference myRef3 = database3.getReference().child("list1");
                myRef3.addValueEventListener(new ValueEventListener() {
                    @Override
                    public void onDataChange(@NonNull DataSnapshot dataSnapshot) {
                        for (DataSnapshot child2: dataSnapshot.getChildren()){
                            Map<String, Object> newPost = (Map<String, Object>) child2.getValue();
                            if(result_dept.equals(newPost.get("department")) && !(result.equals(newPost.get("name")))){
                                //System.out.println("Accessed for list 2 "+ newPost.get("phone"));
                                if(ContextCompat.checkSelfPermission(getApplicationContext(),Manifest.permission.SEND_SMS) != PackageManager.PERMISSION_GRANTED){
                                    if(ActivityCompat.shouldShowRequestPermissionRationale(attend.this,Manifest.permission.SEND_SMS)){

                                    }
                                    else{
                                        ActivityCompat.requestPermissions( attend.this, new String[]{Manifest.permission.SEND_SMS},per);
                                    }
                                }
                                SmsManager smgr = SmsManager.getDefault();
                                smgr.sendTextMessage( newPost.get("phone").toString(),null,result+ " is attending the issue in "+ result_dept,null,null);
                                //Toast.makeText(getApplicationContext(),"Message Sent to List 2",Toast.LENGTH_LONG).show();
                                new AlertDialog.Builder(attend.this)
                                        .setTitle("Issue Attended")
                                        .setMessage("Issue Attended")

                                        // Specifying a listener allows you to take an action before dismissing the dialog.
                                        // The dialog is automatically dismissed when a dialog button is clicked.
                                        .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                            public void onClick(DialogInterface dialog, int which) {
                                                // Continue with delete operation
                                            }
                                        })
                                        // A null listener allows the button to dismiss the dialog and take no further action.
                                        .setNegativeButton(android.R.string.no, null)
                                        .setIcon(android.R.drawable.ic_dialog_alert)
                                        .show();
                            }
                        }
                    }

                    @Override
                    public void onCancelled(@NonNull DatabaseError databaseError) {

                    }
                });
                }
        });
    }
}