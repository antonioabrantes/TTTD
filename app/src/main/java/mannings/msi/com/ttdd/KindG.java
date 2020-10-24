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

import mannings.msi.com.ttdd.model.Registro;

public class KindG extends AppCompatActivity {

    private ListView listView;
    private ArrayList<String> mensagens;
    private ArrayAdapter<String> adapter;
    private Toolbar toolbar;
    SharedPreferences preferences;
    private int proxima_tela;
    private int count_proximo;
    private Document doc;
    private int id,indice,proximo;
    private String texto;
    private String grupo,kind,assunto,fase_corrente,fase_intermediaria,destinacao,observacoes;
    private String[] array_classes = new String[40];
    private String[] array_assunto = new String[40];
    private int[] array_proximo = new int[40];;
    private String[] array_fase_corrente = new String[40];
    private String[] array_fase_intermediaria = new String[40];
    private String[] array_destinacao = new String[40];
    private String[] array_observacoes = new String[255];

    private String[] descricao = {
            "000 — ADMINISTRAÇÃO GERAL",
            "900 — ADMINISTRAÇÃO DE ATIVIDADES ACESSÓRIAS"
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_kind_g);

        listView=(ListView)findViewById(R.id.listViewKindG);
        toolbar = (Toolbar) findViewById(R.id.toolbarKindG);
        setSupportActionBar(toolbar);

        preferences = getSharedPreferences("status_app", MODE_PRIVATE);
        SharedPreferences.Editor editor = preferences.edit();
        editor.putBoolean("app_encerrado", false);
        editor.apply();

        Bundle extras = getIntent().getExtras();
        proxima_tela = extras.getInt("proxima_tela");

        mensagens = new ArrayList<String>();
        adapter = new ArrayAdapter(KindG.this, android.R.layout.simple_list_item_1,mensagens);
        listView.setAdapter( adapter );
        mensagens.clear();

        try{
            AssetManager mngr = this.getAssets();
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
            doc = dBuilder.parse(mngr.open("xml/kind.xml"));

            doc.getDocumentElement().normalize();
            NodeList nodeContatos = doc.getElementsByTagName("row");
            int counter = nodeContatos.getLength();
            count_proximo=1;
            mensagens.add("<<<");
            for (int i = 0; i < counter; i++) {
                Node item = nodeContatos.item(i);
                if (item.getNodeType() == Node.ELEMENT_NODE) {
                    Element element = (Element) item;
                    Node nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    nodeNome = element.getElementsByTagName("field").item(0).getChildNodes().item(0);
                    id = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(1).getChildNodes().item(0);
                    grupo = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(3).getChildNodes().item(0);
                    assunto = nodeNome.getNodeValue().toString();
                    nodeNome = element.getElementsByTagName("field").item(8).getChildNodes().item(0);
                    indice = Integer.parseInt(nodeNome.getNodeValue().toString());
                    nodeNome = element.getElementsByTagName("field").item(9).getChildNodes().item(0);
                    proximo = Integer.parseInt(nodeNome.getNodeValue().toString());

                    if (indice==proxima_tela) {
                        array_proximo[count_proximo]=proximo;
                        array_classes[count_proximo]=grupo;
                        array_assunto[count_proximo]=assunto;

                        texto = grupo + " " + assunto;
                        mensagens.add(texto);
                        nodeNome = element.getElementsByTagName("field").item(4).getChildNodes().item(0);
                        array_fase_corrente[count_proximo] = nodeNome.getNodeValue().toString();
                        nodeNome = element.getElementsByTagName("field").item(5).getChildNodes().item(0);
                        array_fase_intermediaria[count_proximo] = nodeNome.getNodeValue().toString();
                        nodeNome = element.getElementsByTagName("field").item(6).getChildNodes().item(0);
                        array_destinacao[count_proximo] = nodeNome.getNodeValue().toString();
                        nodeNome = element.getElementsByTagName("field").item(7).getChildNodes().item(0);
                        array_observacoes[count_proximo] = nodeNome.getNodeValue().toString();
                        count_proximo = count_proximo+1;

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
                if (position==0){
                    finish();
                }else {
                    if (array_proximo[position]==0) {
                        String str2 = array_classes[position];
                        Toast.makeText(getBaseContext(), "Este grupo "+str2+" não tem subgrupos ", Toast.LENGTH_LONG).show();
                    }
                    else {
                        Intent intent = new Intent(KindG.this, KindZ.class);
                        proxima_tela = array_proximo[position];
                        intent.putExtra("proxima_tela", proxima_tela);
                        startActivity(intent);
                    }
                }
            }
        });

        listView.setLongClickable(true);
        listView.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener(){
            @Override
            public boolean onItemLongClick(AdapterView<?> av, View v, int pos, long id)
            {
                //if (array_fase_corrente[pos].equals(" ")&&
                //        array_fase_intermediaria[pos].equals(" ")&&
                //        array_destinacao[pos].equals(" ")&&
                //        array_observacoes[pos].equals(" ")){

                //    Toast.makeText(KindG.this, "Não há dados de temporalidade", Toast.LENGTH_LONG).show();

                //}
                //else {
                //    if (array_observacoes[pos].equals(" ")) {
                //        texto = "Fase corrente: " + array_fase_corrente[pos] + "\n" +
                //                "Fase intermediária: " + array_fase_intermediaria[pos] + "\n" +
                //                "Destinação: " + array_destinacao[pos];
                //    } else {
                //        texto = "Fase corrente: " + array_fase_corrente[pos] + "\n" +
                //                "Fase intermediária: " + array_fase_intermediaria[pos] + "\n" +
                //                "Destinação: " + array_destinacao[pos] + "\n" +
                //                "Observações: " + array_observacoes[pos];
                //    }
                    //Toast.makeText(KindG.this, texto, Toast.LENGTH_LONG).show();
                    Intent intent = new Intent(KindG.this, Temporal.class);
                    String iclasses = array_classes[pos];
                    String iassunto = array_assunto[pos];
                    String ifasecor = array_fase_corrente[pos];
                    String ifaseint = array_fase_intermediaria[pos];
                    String idestina = array_destinacao[pos];
                    String iobserva = array_observacoes[pos];
                    intent.putExtra("iclasses", iclasses);
                    intent.putExtra("iassunto", iassunto);
                    intent.putExtra("ifasecor", ifasecor);
                    intent.putExtra("ifaseint", ifaseint);
                    intent.putExtra("idestina", idestina);
                    intent.putExtra("iobserva", iobserva);
                    startActivity(intent);

                //}

                return true;
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
