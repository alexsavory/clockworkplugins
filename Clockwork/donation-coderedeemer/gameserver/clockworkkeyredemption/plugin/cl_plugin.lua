function DonationKeyEnter()
		local frame = vgui.Create("DFrame")
		frame:SetPos(ScrW()/2-200,ScrH()/2-100)
		frame:SetSize(400,100)
		frame:SetTitle("Enter Donation Code")
		frame:SetVisible(true)
		frame:ShowCloseButton(true)
		frame:MakePopup()
		frame.Paint = function()
			draw.RoundedBox(4,0,0,frame:GetWide(),frame:GetTall(),Color(0,0,0,170))
		end
		
		local label = vgui.Create("DLabel", frame)
		label:SetText("Enter your code and press enter: ")
		label:SetPos(10,40)
		label:SizeToContents()
		
		local textbox = vgui.Create("DTextEntry", frame)
		textbox:SetPos(15+label:GetWide(),40)
		textbox:SetSize(200,20)
		textbox:SetEnterAllowed(true)
		textbox.OnEnter = function()
			if(textbox:GetValue() == "") then return end
			net.Start("cl_sendDonationKey")
				net.WriteString(textbox:GetValue())
			net.SendToServer()
		end
end
	
	concommand.Add("enterdonationkey",DonationKeyEnter)
