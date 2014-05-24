TOOL.Category		= "Clockwork Tools [Tru]"
TOOL.Name			= "#Tool.staticprop.name"
TOOL.Command		= nil
TOOL.ConfigName		= ""


if CLIENT then
	language.Add( "Tool.staticprop.name", "Static Props! (Untested)" )
	language.Add( "Tool.staticprop.desc", "*static*" )
	language.Add( "Tool.staticprop.0", "Primary: Set Static Secondary: Unset" )
end

TOOL.ClientConVar[ "toggle" ]		= ""



function TOOL:LeftClick( tr )
	local Clockwork = Clockwork
	local Ply = self:GetOwner()

if not Ply:IsAdmin() then 
	return false
end
	local target = Ply:GetEyeTraceNoCursor().Entity;
	if (IsValid(target)) then
		if (Clockwork.entity:IsPhysicsEntity(target)) then
			for k, v in pairs(cwStaticProps.staticProps) do
				if (target == v) then
					Clockwork.player:Notify(Ply, "This prop is already static!");
					
					return;
				end;
			end;
			
			cwStaticProps.staticProps[#cwStaticProps.staticProps + 1] = target;
			cwStaticProps:SaveStaticProps();
			
			Clockwork.player:Notify(Ply, "You have added a static prop.");
		else
			Clockwork.player:Notify(Ply, "This entity is not a physics entity!");
		end;
	else
		Clockwork.player:Notify(Ply, "You must look at a valid entity!");
	end;
end



function TOOL:RightClick( tr )
local Clockwork = Clockwork
	local ply = self:GetOwner()
	local target = ply:GetEyeTraceNoCursor().Entity;

if not ply:IsAdmin() then 
	return false
end
	
	

	if (IsValid(target)) then
		if (Clockwork.entity:IsPhysicsEntity(target)) then
			for k, v in pairs(cwStaticProps.staticProps) do
				if (target == v) then
					cwStaticProps.staticProps[k] = nil;
					cwStaticProps:SaveStaticProps();
					
					Clockwork.player:Notify(ply, "You have removed a static prop.");
					
					return;
				end;
			end;
		else
			Clockwork.player:Notify(ply, "This entity is not a physics entity!");
		end;
	else
		Clockwork.player:Notify(ply, "You must look at a valid entity!");
	end;

end


function TOOL.BuildCPanel( CPanel )

	-- HEADER
	CPanel:AddControl( "Header", { Text = "#tool.staticprop.name", Description	= "#tool.staticprop.desc" }  )
end
