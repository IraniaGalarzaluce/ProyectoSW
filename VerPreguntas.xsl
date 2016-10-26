<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">

<HTML> 
	<BODY> <P> PREGUNTAS.XML </P>
	<TABLE border="1">
		<THEAD>
			<TR> <TH> PREGUNNTA </TH> <TH>TEMA</TH> <TH>COMPLEJIDAD</TH> <TH>RESPUESTA</TH></TR>
		</THEAD>
		<xsl:for-each select="/assessmentItems/assessmentItem" >
			<TR>
				<TD>
					<xsl:value-of select="itemBody/p"/> <BR/>
				</TD>
				<TD>
					<xsl:value-of select="@subject"/> <BR/>
				</TD>
				<TD>
					<xsl:value-of select="@complexity"/> <BR/>
				</TD>
				<TD>
					<xsl:value-of select="correctResponse/value"/> <BR/>
				</TD>
			</TR>
		</xsl:for-each>
	</TABLE>
	</BODY>
</HTML>

</xsl:template>
</xsl:stylesheet>