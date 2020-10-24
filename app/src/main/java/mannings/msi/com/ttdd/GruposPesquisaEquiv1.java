package mannings.msi.com.ttdd;

import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.AssetManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.Node;
import org.w3c.dom.NodeList;

import java.util.ArrayList;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;

public class GruposPesquisaEquiv1 extends AppCompatActivity {

    private ListView listView;
    private ArrayList<String> mensagens;
    private ArrayAdapter<String> adapter;
    private String[] array_classes = new String[100];
    private String[] array_mensagem = new String[100];

    SharedPreferences preferences;
    private Toolbar toolbar;
    private Document doc;
    private int id,pos;
    private String symbol1,assunto1,symbol2,assunto2,grupo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_grupos_pesquisa_equiv1);
        toolbar = (Toolbar) findViewById(R.id.toolbarEquiv1);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        Bundle extras = getIntent().getExtras();
        grupo = extras.getString("grupo").trim();

        listView=(ListView)findViewById(R.id.listViewEquiv1);
        mensagens = new ArrayList<String>();
        adapter = new ArrayAdapter(GruposPesquisaEquiv1.this, android.R.layout.simple_list_item_1,mensagens);
        listView.setAdapter( adapter );
        mensagens.clear();
        array_mensagem[0]="<<<";
        mensagens.add(array_mensagem[0]);
        pos=1;

        try{
            AssetManager mngr = this.getAssets();
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
            doc = dBuilder.parse(mngr.open("xml/codequi.xml"));

            doc.getDocumentElement().normalize();
            NodeList nodeContatos = doc.getElementsByTagName("row");
            int counter = nodeContatos.getLength();
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    symbol1 = nodeNome.getNodeValue().toString().trim();
                    nodeNome = element.getElementsByTagName("field").item(2).getChildNodes().item(0);
                    assunto1 = nodeNome.getNodeValue().toString().trim();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    symbol2 = nodeNome.getNodeValue().toString().trim();
                    nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                    assunto2 = nodeNome.getNodeValue().toString().trim();

                    if (symbol1.equals(grupo)) {
                        array_classes[pos]=symbol2;
                        array_mensagem[pos]=assunto2;
                        mensagens.add(symbol2+" "+assunto2);
                        pos = pos + 1;
                        //Toast.makeText(GruposPesquisaEquiv1.this,"novo simbolo="+symbol2,Toast.LENGTH_LONG).show();
                    }
                }
            }
            adapter.notifyDataSetChanged();

        } catch (Exception e) {
            e.printStackTrace();
        }

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                if (position==0) {
                    finish();
                } else {
                    grupo = array_classes[position];
                    Intent intent = new Intent(GruposPesquisaEquiv1.this, GruposPesquisa.class);
                    intent.putExtra("grupo", grupo);
                    startActivity(intent);
                }
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
