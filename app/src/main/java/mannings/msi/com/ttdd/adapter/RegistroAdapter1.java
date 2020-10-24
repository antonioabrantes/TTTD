package mannings.msi.com.ttdd.adapter;


import android.content.Context;
import android.graphics.Color;
import android.graphics.Typeface;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;

import mannings.msi.com.ttdd.R;
import mannings.msi.com.ttdd.model.RegistroOnos1;

public class RegistroAdapter1 extends ArrayAdapter<RegistroOnos1> {

    private ArrayList<RegistroOnos1> registros;
    private Context context;

    public RegistroAdapter1(Context c, ArrayList<RegistroOnos1> objects) {
        super(c, 0, objects);
        this.registros = objects;
        this.context = c;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        View view = null;

        // Verifica se a lista está vazia
        if( registros != null ){

            // inicializar objeto para montagem da view
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);

            // Monta view a partir do xml
            view = inflater.inflate(R.layout.lista_registro1, parent, false);

            // recupera elemento para exibição
            TextView tvAssunto = (TextView) view.findViewById(R.id.tv_assunto1);
            TextView tvSubAssunto = (TextView) view.findViewById(R.id.tv_subAssunto1);
            //tvSubAssunto.setTextColor(Color.DKGRAY);
            tvAssunto.setTypeface(null, Typeface.BOLD);
            Typeface font = Typeface.createFromAsset(context.getAssets(), "fonts/lucidatypewriterregular.ttf");
            tvAssunto.setTypeface( font );
            //tvSubAssunto.setTypeface(null, Typeface.BOLD);

            RegistroOnos1 registro = registros.get( position );
            tvAssunto.setText( registro.getAssunto());
            tvSubAssunto.setText( registro.getSubAssunto() );

        }

        return view;

    }
}

