package mannings.msi.com.ttdd;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.webkit.JavascriptInterface;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.Toast;

public class Equivalencia extends AppCompatActivity {

    WebView wvGrafico;
    private String strURL;
    private Toolbar toolbar;
    SharedPreferences preferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_equivalencia);

        toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        strURL="file:///android_asset/site/ttdd.htm";
        //strURL="http://www.livroandroid.com.br/livro/carros/sobre.htm";
        wvGrafico = (WebView)findViewById(R.id.wvGrafico);

        wvGrafico.getSettings().setJavaScriptEnabled(true);
        wvGrafico.setWebChromeClient(new WebChromeClient());
        wvGrafico.getSettings().setJavaScriptEnabled(true);
        wvGrafico.getSettings().setDomStorageEnabled(true);
        wvGrafico.getSettings().setLoadWithOverviewMode(true);
        wvGrafico.getSettings().setUseWideViewPort(true);
        wvGrafico.getSettings().setSupportMultipleWindows(true);
        wvGrafico.getSettings().setJavaScriptCanOpenWindowsAutomatically(true);
        wvGrafico.setHorizontalScrollBarEnabled(false);
        wvGrafico.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
        wvGrafico.getSettings().setAllowFileAccessFromFileURLs(true);
        wvGrafico.getSettings().setAllowUniversalAccessFromFileURLs(true);
        wvGrafico.addJavascriptInterface(this, "LivroAndroid");
        wvGrafico.loadUrl(strURL);
        monitoraWebView(wvGrafico);
    }

    @JavascriptInterface
    public void voltar(String grupo){
        //Toast.makeText(Equivalencia.this,"id="+id,Toast.LENGTH_LONG).show();
        Intent intent = new Intent(Equivalencia.this, GruposPesquisa.class);
        intent.putExtra("grupo", grupo);
        startActivity(intent);
    }

    private void monitoraWebView(WebView webview) {
        webview.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageStarted(WebView view, String url, Bitmap favicon) {
                super.onPageStarted(view, url, favicon);
            }
            @Override
            public void onPageFinished(WebView view, String url) {
                super.onPageFinished(view, url);
                ProgressBar progress = (ProgressBar) findViewById(R.id.progress);
                progress.setVisibility(View.INVISIBLE);
            }
        });
    }
    protected void onStart(){
        super.onStart();
        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        if (preferences.getBoolean("app_encerrado",false)) finish();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_main,menu);

        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch(item.getItemId()){
            case R.id.item_sair:
                preferences = getSharedPreferences("status_app", MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.putBoolean("app_encerrado", true);
                editor.apply();
                finish();
                return true;
            case R.id.item_pesquisa:
                pesquisa();
                return true;
            case R.id.item_inicio:
                vaParaTelaInicial();
                return true;
            case R.id.item_busca_equiv:
                pesquisaEquiv();
                return true;
            case R.id.item_equiv:
                //TelaEquivalencia();
                return true;
            case R.id.item_about:
                TelaAbout();
                return true;
            case R.id.item_ajuda:
                TelaAjuda();
                return true;
            case R.id.item_onosmatico:
                pesquisa_onosmatico();
                return true;
            default:
                return super.onOptionsItemSelected(item);

        }

    }

    public void pesquisa_onosmatico(){
        Intent intent = new Intent(getApplicationContext(),Onosmatico.class);
        startActivity(intent);
        //finish();
    }

    public void pesquisa(){
        Intent intent = new Intent(getApplicationContext(),Pesquisa.class);
        startActivity(intent);
        //finish();
    }

    public void pesquisaEquiv(){
        Intent intent = new Intent(getApplicationContext(),PesquisaEquiv.class);
        startActivity(intent);
        //finish();
    }

    public void vaParaTelaInicial(){
        Intent intent = new Intent(getApplicationContext(),MainActivity.class);
        startActivity(intent);
        finish();
    }

    public void TelaAbout(){
        Intent intent = new Intent(getApplicationContext(),About.class);
        startActivity(intent);
        finish();
    }

    public void TelaAjuda(){
        Intent intent = new Intent(getApplicationContext(),Ajuda.class);
        startActivity(intent);
        finish();
    }

    public void TelaEquivalencia(){
        Intent intent = new Intent(getApplicationContext(),Equivalencia.class);
        startActivity(intent);
        finish();
    }

}
