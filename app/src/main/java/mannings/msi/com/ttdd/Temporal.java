package mannings.msi.com.ttdd;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class Temporal extends AppCompatActivity {

    private Toolbar toolbar;
    private int proxima_tela = 0;
    private String idioma;
    SharedPreferences preferences;
    TextView textViewT1,textViewT2,textViewT3,textViewT4,textViewT5,textViewT6,textViewT3A,textViewT4A,textViewT5A;
    ImageView imageViewBack;
    private Button btnExplica;
    private String iclasses,iassunto;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_temporal);
        toolbar = (Toolbar) findViewById(R.id.toolbarTemporal);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        Bundle extras = getIntent().getExtras();
        iclasses = extras.getString("iclasses");
        iassunto = extras.getString("iassunto");
        String ifasecor = extras.getString("ifasecor");
        String ifaseint = extras.getString("ifaseint");
        String idestina = extras.getString("idestina");
        String iobserva = extras.getString("iobserva");

        textViewT1 = (TextView) findViewById(R.id.textViewT1);
        textViewT2 = (TextView) findViewById(R.id.textViewT2);
        textViewT3 = (TextView) findViewById(R.id.textViewT3);
        textViewT3A = (TextView) findViewById(R.id.textViewT3A);
        textViewT4 = (TextView) findViewById(R.id.textViewT4);
        textViewT4A = (TextView) findViewById(R.id.textViewT4A);
        textViewT5 = (TextView) findViewById(R.id.textViewT5);
        textViewT5A = (TextView) findViewById(R.id.textViewT5A);
        textViewT6 = (TextView) findViewById(R.id.textViewT6);
        imageViewBack = (ImageView) findViewById(R.id.imageViewBack);
        btnExplica = (Button) findViewById(R.id.btnExplica);

        Typeface font = Typeface.createFromAsset(getAssets(), "fonts/Sansation-Bold.ttf");
        textViewT1.setTypeface(font);
        textViewT1.setTextSize(16);
        textViewT1.setText(iclasses);

        textViewT2.setTypeface(font);
        textViewT2.setTextSize(14);
        textViewT2.setText(iassunto);

        if (ifasecor.equals(" ")&&
                ifaseint.equals(" ")&&
                idestina.equals(" ")&&
                iobserva.equals(" ")){

            textViewT3A.setText(" ");
            textViewT4A.setText(" ");
            textViewT5A.setText(" ");

            textViewT3.setTypeface( font );
            textViewT3.setTextSize(16);
            textViewT3.setText("Não há dados de temporalidade");

        } else {

            textViewT3A.setText("Fase corrente: ");
            textViewT4A.setText("Fase intermediaria: ");
            textViewT5A.setText("Destinação: ");

            if (!ifasecor.equals(" ") && !ifasecor.equals("")) {
                textViewT3.setTypeface(font);
                textViewT3.setTextSize(16);
                textViewT3.setText(ifasecor);
            } else {
                textViewT3.setTypeface(font);
                textViewT3.setTextSize(16);
                textViewT3.setText("-");
            }

            if (!ifaseint.equals(" ") && !ifaseint.equals("")) {
                textViewT4.setTypeface(font);
                textViewT4.setTextSize(16);
                textViewT4.setText(ifaseint);
            } else {
                textViewT4.setTypeface(font);
                textViewT4.setTextSize(16);
                textViewT4.setText("-");
            }

            if (!idestina.equals(" ") && !idestina.equals("")) {
                textViewT5.setTextSize(16);
                textViewT5.setText(idestina);
            } else {
                textViewT5.setTextSize(16);
                textViewT5.setText("-");
            }

            if (!iobserva.equals(" ") && !iobserva.equals("")) {
                textViewT6.setTextSize(12);
                textViewT6.setText("Observações: " + iobserva);
            } else {
                textViewT6.setTextSize(12);
                textViewT6.setText("Observações: -");
            }
        }

        imageViewBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        btnExplica.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Temporal.this, TextoExplica.class);
                intent.putExtra("iclasses", iclasses);
                intent.putExtra("iassunto", iassunto);
                startActivity(intent);
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
                TelaEquivalencia();
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
