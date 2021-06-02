package com.example.workforcemanagementsystem;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.DialogInterface.OnCancelListener;
import android.content.DialogInterface.OnClickListener;
import android.content.DialogInterface.OnKeyListener;
import android.graphics.Bitmap;
import android.os.Message;
import android.util.Log;
import android.view.KeyEvent;
import android.webkit.JsPromptResult;
import android.webkit.JsResult;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.widget.EditText;

/**
 * http://618119.com/archives/2010/12/20/199.html
 */

//****************************************************************************
public class MyWebChromeClient extends WebChromeClient {
    @Override
    public void onCloseWindow(WebView window) {
        super.onCloseWindow(window);
    }

    @Override
    public boolean onCreateWindow(WebView view, boolean dialog,
                                  boolean userGesture, Message resultMsg) {
        return super.onCreateWindow(view, dialog, userGesture, resultMsg);
    }

    /**
     * Override the default window.alert display interface, avoiding the title as ": from file:////"
     */
    public boolean onJsAlert(WebView view, String url, String message,
                             JsResult result) {
        final AlertDialog.Builder builder = new AlertDialog.Builder(view.getContext());

        builder.setTitle("System Message")
                .setMessage(message)
                .setPositiveButton("OK", null);

		// No need to bind key events
        // Shield keys with keycode equal to 84
        builder.setOnKeyListener(new OnKeyListener() {
            public boolean onKey(DialogInterface dialog, int keyCode,KeyEvent event) {
                Log.v("onJsAlert", "keyCode==" + keyCode + "event="+ event);
                return true;
            }
        });
		// Disable response to the event of pressing the back button
        builder.setCancelable(false);
        AlertDialog dialog = builder.create();
        dialog.show();
        result.confirm();// Because there is no binding event, you need to force confirm, otherwise the page will be black and the content will not be displayed.
        return true;
        // return super.onJsAlert(view, url, message, result);
    }

    public boolean onJsBeforeUnload(WebView view, String url,
                                    String message, JsResult result) {
        return super.onJsBeforeUnload(view, url, message, result);
    }

    /**
     * Override the default window.confirm display interface, avoiding the title as ": from file:////"
     */
    public boolean onJsConfirm(WebView view, String url, String message,
                               final JsResult result) {
        final AlertDialog.Builder builder = new AlertDialog.Builder(view.getContext());
        builder.setTitle("Dialog")
                .setMessage(message)
                .setPositiveButton("OK", new OnClickListener() {
                    public void onClick(DialogInterface dialog,int which) {
                        result.confirm();
                    }
                })
                .setNeutralButton("cancel", new OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        result.cancel();
                    }
                });
        builder.setOnCancelListener(new OnCancelListener() {
            @Override
            public void onCancel(DialogInterface dialog) {
                result.cancel();
            }
        });

		// Shield keycode equal to 84 and other keys, to avoid the dialog box after the button message and the page can no longer pop up the dialog box
        builder.setOnKeyListener(new OnKeyListener() {
            @Override
            public boolean onKey(DialogInterface dialog, int keyCode,KeyEvent event) {
                Log.v("onJsConfirm", "keyCode==" + keyCode + "event="+ event);
                return true;
            }
        });
		// Disable response to the event of pressing the back button
        // builder.setCancelable(false);
        AlertDialog dialog = builder.create();
        dialog.show();
        return true;
        // return super.onJsConfirm(view, url, message, result);
    }

    /**
     * Override the default window.prompt display interface, avoiding the title as ": from file:////"
     * window.prompt ('Please enter your domain address', '618119.com');
     */
    public boolean onJsPrompt(WebView view, String url, String message,
                              String defaultValue, final JsPromptResult result) {
        final AlertDialog.Builder builder = new AlertDialog.Builder(view.getContext());

        builder.setTitle("Dialog").setMessage(message);

        final EditText et = new EditText(view.getContext());
        et.setSingleLine();
        et.setText(defaultValue);
        builder.setView(et)
                .setPositiveButton("OK", new OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        result.confirm(et.getText().toString());
                    }

                })
                .setNeutralButton("cancel", new OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        result.cancel();
                    }
                });

		// Shield keycode equal to 84 and other keys, to avoid the dialog box after the button message and the page can no longer pop up the dialog box
        builder.setOnKeyListener(new OnKeyListener() {
            public boolean onKey(DialogInterface dialog, int keyCode,KeyEvent event) {
                Log.v("onJsPrompt", "keyCode==" + keyCode + "event="+ event);
                return true;
            }
        });

		// Disable response to the event of pressing the back button
        // builder.setCancelable(false);
        AlertDialog dialog = builder.create();
        dialog.show();
        return true;
        // return super.onJsPrompt(view, url, message, defaultValue,
        // result);
    }

    @Override
    public void onProgressChanged(WebView view, int newProgress) {
        super.onProgressChanged(view, newProgress);
    }

    @Override
    public void onReceivedIcon(WebView view, Bitmap icon) {
        super.onReceivedIcon(view, icon);
    }

    @Override
    public void onReceivedTitle(WebView view, String title) {
        super.onReceivedTitle(view, title);
    }

    @Override
    public void onRequestFocus(WebView view) {
        super.onRequestFocus(view);
    }
}
